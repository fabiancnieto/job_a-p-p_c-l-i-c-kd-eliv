<?php

namespace AppBundle\Form\Ums\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AddRoleFieldsSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Listen on the form.pre_set_data event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();
        $role = (!empty($user->getUsrId())) ? $user->getRoles() : array('ROLE_ADMIN');

        if ($role[0] == "ROLE_ADMIN") {
            $form
              ->add('usrPassword',RepeatedType::class,[
                          'type' => PasswordType::class,
                          'first_options' => ['label' => 'Password','attr' => array('class' => 'form-control')],
                          'second_options' => ['label' => 'Confirm Password','attr' => array('class' => 'form-control')],
                          ])
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
            		));
        }
    }
}