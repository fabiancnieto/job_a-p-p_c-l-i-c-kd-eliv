<?php

namespace AppBundle\Security;

use AppBundle\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        var_dump($user);die("sorry!");
        if (!$user instanceof AppUser) {
            return;
        }

        // user is inactive, show a generic Inactive Account Exception message
        if (!$user->getUsrState()) {
            throw new AccountStatusException();
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

    }
}