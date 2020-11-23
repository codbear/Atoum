<?php

namespace App\Security;

use App\Entity\Author;

/**
 * Class BookVoter
 * @package App\Security
 */
class AuthorVoter extends Voter
{
    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports(string $attribute, $subject)
    {
        if (!$this->isActionGranted($attribute)) {
            return false;
        }

        if (!$subject instanceof Author) {
            return false;
        }

        return true;
    }
}