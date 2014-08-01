<?php

namespace SaucisSound\Bundle\CommunityBundle\Handler;

use SaucisSound\Bundle\CommunityBundle\Model\MemberInterface;
use SaucisSound\Bundle\CommunityBundle\Model\MemberRepositoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Interface MemberHandlerInterface
 * @package SaucisSound\Bundle\CommunityBundle\Handler
 */
interface MemberHandlerInterface
{
    /**
     * @param MemberRepositoryInterface $repository repository of the Member entity
     * @param FormFactoryInterface      $form       form factory from Sf2
     */
    public function __construct(MemberRepositoryInterface $repository, FormFactoryInterface $form);

    /**
     * Creates a new Member entity from $properties.
     *
     * @param array $properties properties of the Member entity
     *
     * @return MemberInterface
     */
    public function create(array $properties);

    /**
     * Updates a Member entity.
     *
     * @param MemberInterface $member     Member entity to update
     * @param array           $properties properties to update (key => value)
     *
     * @return MemberInterface
     */
    public function update(MemberInterface $member, array $properties);

    /**
     * Gets a Member entity from an id.
     *
     * @param integer $id             id of the Member entity to get
     * @param boolean $throwException throw exception on not found id?
     *
     * @return MemberInterface
     *
     * @throws NotFoundHttpException on Member entity not found
     */
    public function get($id, $throwException = true);
} 