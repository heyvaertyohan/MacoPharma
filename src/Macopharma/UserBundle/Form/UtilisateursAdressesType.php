<?php

namespace Macopharma\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsersAdressesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rue')
            ->add('cp')
            ->add('ville')
            ->add('pays')
            ->add('complement',null,array('required' => false))
            //->add('user')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Macopharma\UserBundle\Entity\AddressUser'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Macopharma_userbundle_usersadresses';
    }
}
