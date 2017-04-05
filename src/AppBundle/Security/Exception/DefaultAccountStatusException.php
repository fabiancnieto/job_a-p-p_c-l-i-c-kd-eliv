<?php

namespace AppBundle\Security\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

/**
 * Class DefaultAccountStatusException.
 */
class DefaultAccountStatusException extends AccountStatusException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        $user = $this->getUser();

        return 'Your account is not activiated yet please check your email!';
    }
}