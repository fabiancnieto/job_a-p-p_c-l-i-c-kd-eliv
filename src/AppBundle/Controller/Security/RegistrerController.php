<?php

namespace AppBundle\Controller\Security;

use AppBundle\Entity\User;
use AppBundle\Entity\Profile;
use AppBundle\Form\Ums\UserType;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrerController extends Controller
{
    /**
     * @Route("/Register", name="ums_register")
     */
    public function registerAction(Request $request)
    {
        // Create an instance of a user and process the form
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $encrpyt = $this->get('security.password_encoder');
            $password = $encrpyt->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setusrFullName($user->getUsrFirstName()." ".$user->getUsrLastName());
            $user->setUsrState(false);
            $user->setUsrGrantList(false);

            // Set their role
            $em = $this->getDoctrine()->getManager();
            $profile = $em->find('AppBundle\Entity\Profile', 7);
            $user->setPru($profile);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Sucess message
            $this->addFlash(
                'success',
                'Graet your are now register!, we just send an email to activate your account'
            );

            return $this->redirectToRoute('ums_login');
        }

        return $this->render('Security/Login/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}