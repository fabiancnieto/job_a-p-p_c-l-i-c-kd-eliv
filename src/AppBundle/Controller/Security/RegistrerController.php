<?php

namespace AppBundle\Controller\Security;

use AppBundle\Entity\User;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Agent;
use AppBundle\Entity\RegisterLog;
use AppBundle\Form\Ums\UserType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrerController extends Controller
{
    /**
     * @var profile
     */
    private $profile;

    /**
     * @var user
     */
    private $user;

    /**
     * @var registerlog
     */
    private $registerLog;

    /**
     * @Route("/Register", name="ums_register")
     */
    public function registerAction(Request $request)
    {
        // Create an instance of a user and process the form
        $this->user = new User();
        $form = $this->createForm(RegistrationType::class, $this->user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Set the attibutes of the new User
            $this->user->setUsrFullName();
            $this->user->setUsrState();
            $this->user->setUsrGrantList();
            $this->setEncryptPassword();
            $this->setRegistrationRole();
            $this->sendActivationEmail();

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($this->user);
            $em->flush();

            // Success message
            $this->addFlash(
                'success',
                'Graet your are now register!, Check your inbox to verify your email'
            );

            return $this->redirectToRoute('ums_login');
        }

        return $this->render('Security/Login/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ConfirmAccount/{hash}", name="ums_confirm_account")
     */
    public function confirmAccountAction($hash)
    {
        if(!empty($hash)){
            $em = $this->getDoctrine()->getManager();
            $this->registerLog = $em->getRepository('AppBundle\Entity\RegisterLog')
                ->findOneBy(array('hash' => $hash));

            $this->user = $this->registerLog->getUsr();
            $this->user->verifyAccount();
            $em->merge($this->user);
            $em->flush();

            $this->registerLog->getResponseDate(new \DateTime());
            $em->merge($this->user);
            $em->flush();

            // Success message
            $this->addFlash(
                'success',
                'Success your account was verified!'
            );
        }

        return $this->redirectToRoute('ums_login');
    }

    /**
     * Define the role that should be assign to the new user
     */
    private function setRegistrationRole(){
        $em = $this->getDoctrine()->getManager();
        ///Search if this email exists in the Agent Entity
        $agent = $em->getRepository('AppBundle\Entity\Agent')
            ->findOneBy(array('agtEmail' => $this->user->getUsrEmail()));

        if(!empty($agent)){
            $this->profile = $em->getRepository('AppBundle\Entity\Profile')->findOneBy(array('pruName' => "ROLE_AGENT"));
        } else {
            $this->profile = $em->getRepository('AppBundle\Entity\Profile')->findOneBy(array('pruName' => "ROLE_USER"));
        }
        $this->user->setPru($this->profile);
    }

    /**
     * Encode the user plain password and add to the entity User
     */
    private function setEncryptPassword(){
        // Encode the new users password
        $encrpyt = $this->get('security.password_encoder');
        $password = $encrpyt->encodePassword($this->user, $this->user->getPlainPassword());
        $this->user->setPassword($password);
    }

    /**
     * Encode the user plain password and add to the entity User
     */
    private function sendActivationEmail(){
        $this->registerLog = new RegisterLog();
        $this->registerLog->setHash(uniqid ("r3g0ms"));
        $this->registerLog->setUsr($this->user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($this->registerLog);
        $em->flush();

        $message = \Swift_Message::newInstance()
                ->setSubject('Please verify your email address')
                ->setFrom('noreply@mail.notification.com')
                ->setTo($this->user->getUsrEmail())
                ->setBody(
                    $this->renderView(
                        'Emails/registration.html.twig',
                        array('registerlog' => array(
                            'name' => $this->user->getUsrFullName(), 
                            'verifylink' => $this->registerLog->getHash()
                        ))
                    ),
                    'text/html'
                );

        $this->get('mailer')->send($message);

    }

}