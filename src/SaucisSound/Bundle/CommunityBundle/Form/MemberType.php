<?php

namespace SaucisSound\Bundle\CommunityBundle\Form;

use SaucisSound\Bundle\CommunityBundle\Model\MemberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class MemberType
 * @package SaucisSound\Bundle\CommunityBundle\Form
 */
class MemberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('password', 'password')
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'createEventListener']);
    }

    /**
     * Adds some fields when trying to create (instead of update) a Member entity.
     *
     * @param FormEvent $event
     */
    public function createEventListener(FormEvent $event)
    {
        /** @var MemberInterface $member */
        $member = $event->getData();
        $form   = $event->getForm();

        // if this is a new member, we need his email
        if (is_null($member) || is_null($member->getId())) {
            $form->add('email', 'email');
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
                 [
                     'data_class'      => 'SaucisSound\Bundle\CommunityBundle\Entity\Member',
                     'csrf_protection' => false,
                 ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'member';
    }
}
