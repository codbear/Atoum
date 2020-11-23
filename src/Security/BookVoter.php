<?php

namespace App\Security;

use App\Entity\Book;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Class BookVoter
 * @package App\Security
 */
class BookVoter extends Voter
{
    /**
     *
     */
    const GET = 'get';
    /**
     *
     */
    const EDIT = 'edit';
    /**
     *
     */
    const DELETE = 'delete';

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::GET, self::EDIT, self::DELETE])) {
            return false;
        }

        if (!$subject instanceof Book) {
            return false;
        }

        return true;
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

        /**
         * @var Book
         */
        $book = $subject;

        return $user->hasRoles('ROLE_ADMIN') || $user === $book->getOwner();
    }
}