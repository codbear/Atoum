<?php

namespace App\Security;

use App\Entity\Book;

/**
 * Class BookVoter
 * @package App\Security
 */
class BookVoter extends Voter
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

        if (!$subject instanceof Book) {
            return false;
        }

        return true;
    }
}