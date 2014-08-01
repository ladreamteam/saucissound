<?php

namespace SaucisSound\Bundle\CommunityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('email', 'email')
            ->add('password', 'password');
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
