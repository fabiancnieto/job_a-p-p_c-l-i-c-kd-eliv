<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Controller\Security\FacebookConnect\FacebookConnectController;
use AppBundle\Entity\User;
use AppBundle\Entity\Profile;

class FacebookAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var container
     */
    private $container;

    /**
     * @var user
     */
    private $user;

    /**
     * @var profile
     */
    private $profile;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/connect/facebook_check') {
            // skip authentication unless we're on this URL!
            return null;
        }

        if ($code = $request->query->get('code')) {
            return $code;
        }

        throw CustomAuthenticationException::createWithSafeMessage(
            'There was an error getting access from Facebook. Please try again.'
        );
    }

    public function getUser($authorizationCode, UserProviderInterface $userProvider)
    {
        $fbProvider = $this->container->get('app.facebook_provider');
        try {
            // the credentials are really the access token
            $accessToken = $fbProvider->getAccessToken(
                'authorization_code',
                ['code' => $authorizationCode]
            );
        } catch (IdentityProviderException $e) {
            // probably the authorization code has been used already
            $response = $e->getResponseBody();
            $errorCode = $response['error']['code'];
            $message = $response['error']['message'];
            throw CustomAuthenticationException::createWithSafeMessage(
                'There was an error logging you into Facebook - code '.$errorCode
            );
        }

        /** @var FacebookUser $fbUser */
        $fbUser = $fbProvider->getResourceOwner($accessToken);

        $this->user = new User();
        $this->user->setUsrLastName($fbUser->getLastName());
        $this->user->setUsrFirstName($fbUser->getFirstName());
        $this->user->setUsrEmail($fbUser->getEmail());
        $this->user->setUsrState(true);

        return $this->user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if (!$this->user) {
            // throw any AuthenticationException
            throw new BadCredentialsException();
        }
        
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $fbController = new FacebookConnectController();
        $fbController->getUsrByEmail($this->user);

        $aRoles = $this->user->getRoles();
        $url = $this->router->generate(
            'Ums_show', array('usrId' => $this->userProvider->getUsrId())
        );

        if($aRoles[0] == 'ROLE_ADMIN'){
            $url = $this->router->generate('Ums_index');
        }

        return new RedirectResponse($url);
    }

    public function supportsRememberMe()
    {
        // todo
    }
    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->container->get('router')->generate('Ums_index');
    }

    protected function getLoginUrl()
    {
        return $this->container->get('router')
            ->generate('ums_login');
    }


}