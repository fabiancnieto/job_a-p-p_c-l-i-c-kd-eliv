<?php

namespace AppBundle\Form\Ums;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ParameterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('parStringValue',null,array('label' => 'Description', 'attr' => array('class' => 'form-control')))
          ->add('parState',ChoiceType::class,array('choices' => array('Active' => true, 'Inactive' => false), 'label' => 'State', 'attr' => array('class' => 'form-control'))
          );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Parameter'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_parameter';
    }


}
