<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('usrFirstName',null,array('label' => 'First Name', 'attr' => array('class' => 'form-control')))
          ->add('usrLastName',null,array('label' => 'Last Name', 'attr' => array('class' => 'form-control')))
          ->add('usrEmail',EmailType::class,array('label' => 'Email', 'attr' => array('class' => 'form-control')))
          ->add('usrPhoneNumber',null,array('label' => 'Phone number', 'attr' => array('class' => 'form-control')))
          ->add('plainPassword',RepeatedType::class,[
            'type' => PasswordType::class,
            'first_options' => ['label' => 'Password'],
            'second_options' => ['label' => 'Confirm Password'],
            ]
          );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }

}
