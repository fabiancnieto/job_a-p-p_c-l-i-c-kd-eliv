<?php

namespace AppBundle\Form\Ums;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Parameter;
use AppBundle\Form\Ums\EventListener\AddRoleFieldsSubscriber;

class UserType extends AbstractType
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
          ->add('usrPhoneNumber',null,array('label' => 'Phone number', 'attr' => array('class' => 'form-control')));

        $builder->addEventSubscriber(new AddRoleFieldsSubscriber());
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
