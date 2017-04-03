<?php

namespace AppBundle\Controller\Security\FacebookConnect;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FacebookConnectController extends Controller
{

    /**
     * @var em
     */
    private $em;

    /**
     * @Route("/connect/facebook", name="ums_connect_facebook")
     */
    public function connectFacebookAction(Request $request)
    {
        // redirect to Facebook
        $fbOAuthProvider = $this->get('app.facebook_provider');
        $url = $fbOAuthProvider->getAuthorizationUrl([
            // these are actually the default scopes
            'scopes' => ['public_profile', 'email'],
        ]);

        ///$this->getUsrByEmail($fbUser);

        return $this->redirect($url);
    }

    /**
     * @Route("/connect/facebook_check", name="ums_connect_facebook_check")
     */
    public function connectFacebookActionCheck()
    {
        // will not be reached!
    }


    public function getUsrByEmail($user)
    {
        $this->em = $this->getDoctrine()->getManager();
        ///Search if this email exists in the Agent Entity
        $this->user = $this->em->getRepository('AppBundle\Entity\User')
            ->findOneBy(array('usrEmail' => $fbUser->getEmail()));

        if(!empty($this->user)){
            return;
        } else {
            $this->user = new User();
            $this->user = $user;

            $this->setRegistrationRole($fbUser->getEmail());

            // Save
            $this->em->persist($this->user);
            $this->em->flush();
        }
     }

    /**
     * Define the role that should be assign to the new user
     */
    private function setRegistrationRole($email){
        $em = $this->getDoctrine()->getManager();
        ///Search if this email exists in the Agent Entity
        $agent = $em->getRepository('AppBundle\Entity\Agent')
            ->findOneBy(array('agtEmail' => $email));

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
}