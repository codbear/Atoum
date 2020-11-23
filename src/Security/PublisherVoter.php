<?php

namespace App\Security;

use App\Entity\Publisher;

/**
 * Class BookVoter
 * @package App\Security
 */
class PublisherVoter extends Voter
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

        if (!$subject instanceof Publisher) {
            return false;
        }

        return true;
    }
}