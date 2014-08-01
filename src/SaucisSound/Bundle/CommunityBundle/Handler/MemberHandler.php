<?php

namespace SaucisSound\Bundle\CommunityBundle\Handler;

use SaucisSound\Bundle\CommunityBundle\Entity\Member;
use SaucisSound\Bundle\CommunityBundle\Form\MemberType;
use SaucisSound\Bundle\CommunityBundle\Model\MemberInterface;
use SaucisSound\Bundle\CommunityBundle\Model\MemberRepositoryInterface;
use SaucisSound\Bundle\CoreBundle\Exception\SaucisSoundException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MemberHandler
 * @package SaucisSound\Bundle\CommunityBundle\Handler
 */
class MemberHandler implements MemberHandlerInterface
{
    /**
     * @var MemberRepositoryInterface
     */
    private $repository;

    /**
     * @var FormFactoryInterface
     */
    private $form;

    /**
     * @param MemberRepositoryInterface $repository repository of the Member entity
     * @param FormFactoryInterface      $form       form factory from Sf2
     */
    public function __construct(MemberRepositoryInterface $repository, FormFactoryInterface $form)
    {
        $this->repository = $repository;
        $this->form       = $form;
    }

    /**
     * Creates a new Member entity from $properties.
     *
     * @param array $properties properties of the Member entity
     *
     * @return MemberInterface
     */
    public function create(array $properties)
    {
        return $this->process(new Member(), $properties, 'POST');
    }

    /**
     * Updates a Member entity.
     *
     * @param MemberInterface $member     Member entity to update
     * @param array           $properties properties to update (key => value)
     * @param boolean         $partial    update partially the Member entity?
     *
     * @return MemberInterface
     */
    public function update(MemberInterface $member, array $properties, $partial = true)
    {
        $method = $partial ? 'PATCH' : 'PUT';

        return $this->process($member, $properties, $method);
    }

    /**
     * Gets a Member entity from an id.
     *
     * @param integer $id             id of the Member entity to get
     * @param boolean $throwException throw exception on not found id?
     *
     * @return MemberInterface
     *
     * @throws SaucisSoundException on Member entity not found
     */
    public function get($id, $throwException = true)
    {
        $id             = (int) $id;
        $throwException = (bool) $throwException;

        $member = $this->repository->find($id);

        if (is_null($member) && $throwException) {
            throw new SaucisSoundException(new NotFoundHttpException('Unable to find the Member entity'));
        }

        return $member;
    }

    /**
     * Updates the Member entity with the related form for the given properties.
     *
     * @param MemberInterface $member     Member entity to process
     * @param array           $properties properties to set
     * @param string          $method     method used to process (PUT, POST, PATCH)
     *
     * @return MemberInterface
     *
     * @throws SaucisSoundException on failed validation
     */
    private function process(MemberInterface $member, array $properties, $method)
    {
        $clearMissing = $method !== 'PATCH';

        $form = $this->form->create(new MemberType(), $member, ['method' => $method]);
        $form->submit($properties, $clearMissing);

        if (!$form->isValid()) {
            throw new SaucisSoundException(
                new BadRequestHttpException('Unable to get a valid result from these properties.'),
                $form
            );
        }

        return $form->getData();
    }
}