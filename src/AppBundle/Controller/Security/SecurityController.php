<?php

namespace AppBundle\Controller\Security;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/", name="ums_login")
     */
    public function loginAction(Request $request)
    {
       $helper = $this->get('security.authentication_utils');

       return $this->render(
           'Security/Login/login.html.twig',
           array(
               'last_username' => $helper->getLastUsername(),
               'error'         => $helper->getLastAuthenticationError(),
           )
       );
    }

    /**
     * @Route("/login_check", name="ums_security_login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/logout", name="ums_logout")
     */
    public function logoutAction()
    {

    }
    
}