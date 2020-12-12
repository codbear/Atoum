<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class Voter
 * @package App\Security
 */
abstract class Voter extends \Symfony\Component\Security\Core\Authorization\Voter\Voter
{
    const GET = 'get';
    const POST = 'post';
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * @param $action
     * @return bool
     */
    protected function isActionGranted($action)
    {
        return in_array($action, [self::GET, self::POST, self::EDIT, self::DELETE]);
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports(string $attribute, $subject)
    {
        return false;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return $user === $subject->getOwner();
    }
}