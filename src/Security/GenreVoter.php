<?php

namespace App\Security;

use App\Entity\Genre;

/**
 * Class GenreVoter
 * @package App\Security
 */
class GenreVoter extends Voter
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

        if (!$subject instanceof Genre) {
            return false;
        }

        return true;
    }
}