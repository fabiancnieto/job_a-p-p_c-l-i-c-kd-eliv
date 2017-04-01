<?php

namespace AppBundle\Form\Ums;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Parameter;
use Doctrine\ORM\EntityRepository;
=======
>>>>>>> master

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
          ->add('usrFirstName',null,array('label' => 'First Name', 'attr' => array('class' => 'form-control')))
          ->add('usrLastName',null,array('label' => 'Last Name', 'attr' => array('class' => 'form-control')))
          ->add('usrEmail',EmailType::class,array('label' => 'Email', 'attr' => array('class' => 'form-control')))
          ->add('usrPhoneNumber',null,array('label' => 'Phone number', 'attr' => array('class' => 'form-control')))
          ->add('usrState',ChoiceType::class,array('choices' => array('ACTIVE' => true, 'INACTIVE' => false), 'label' => 'State', 'attr' => array('class' => 'form-control')))
          ->add('usrGrantList',ChoiceType::class,array('choices' => array('YES' => true, 'NO' => false), 'label' => 'View Privileges', 'attr' => array('class' => 'form-control')))
          ->add('pru',EntityType::class,array(
             'class' => 'AppBundle:Profile',
             'choice_label' => function ($profile, $key, $index) {
          	/** @var Profile $profile */
          	  return strtoupper($profile->getPruName());
             },
             'choice_attr' => function ($profile, $key, $index) {
          	  /** @var Profile $profile */
          	  return ['class' => 'form-control '.strtolower($profile->getPruName())];
             },
              'label' => 'Profile','attr' => array('class' => 'form-control')
            )
          );
=======
          ->add('usrFirstName')
          ->add('usrLastName')
          ->add('usrEmail')
          ->add('usrPhoneNumber')
          ->add('usrPassword')
          ->add('usrGrantList')
          ->add('pru');
>>>>>>> master
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
