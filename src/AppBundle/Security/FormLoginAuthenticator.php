<?php
namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Security;
use AppBundle\Security\Exception\DefaultAccountStatusException;

class FormLoginAuthenticator extends AbstractFormLoginAuthenticator
{
    private $router;
    private $encrypter;
    private $userProvider;

    public function __construct(RouterInterface $router, UserPasswordEncoderInterface $encrypter)
    {
        $this->router = $router;
        $this->encrypter = $encrypter;
    }

    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/login_check') {
          return;
        }

        $email = $request->request->get('_email');
        $request->getSession()->set(Security::LAST_USERNAME, $email);
        $password = $request->request->get('_password');

        return [
            'email' => $email,
            'password' => $password,
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $email = $credentials['email'];
        $this->userProvider = $userProvider->loadUserByUsername($email);

        return $this->userProvider;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $plainPassword = $credentials['password'];
        if (!$this->encrypter->isPasswordValid($user, $plainPassword)) {
            throw new BadCredentialsException();
        } elseif(!$user->getUsrState()){
            throw new DefaultAccountStatusException();
        }

        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $aRoles = $this->userProvider->getRoles();
        $url = $this->router->generate(
            'Ums_show', array('usrId' => $this->userProvider->getUsrId())
        );

        if($aRoles[0] == 'ROLE_ADMIN'){
            $url = $this->router->generate('Ums_index');
        }

        return new RedirectResponse($url);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
       $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

       $url = $this->router->generate('ums_login');

       return new RedirectResponse($url);
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('ums_login');
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('Ums_index');
    }

}