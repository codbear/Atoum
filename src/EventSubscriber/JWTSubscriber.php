<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class JWTSubscriber
 * @package App\EventSubscriber
 */
class JWTSubscriber implements EventSubscriberInterface
{
    /**
     * @param JWTCreatedEvent $event
     */
    public function onLexikJwtAuthenticationOnJwtCreated(JWTCreatedEvent $event): void
    {
        $data = $event->getData();
        $user = $event->getUser();

        if ($user instanceof User) {
            $data['email'] = $user->getEmail();
        } else {
            $data['username'] = $user->getUsername();
        }

        $event->setData($data);
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'lexik_jwt_authentication.on_jwt_created' => 'onLexikJwtAuthenticationOnJwtCreated',
        ];
    }
}
