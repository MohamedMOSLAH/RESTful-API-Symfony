<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LogoutSubscriber implements EventSubscriberInterface
{
    public function onLogoutEvent($event): void
    {
        // ...
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'LogoutEvent' => 'onLogoutEvent',
        ];
    }
}
