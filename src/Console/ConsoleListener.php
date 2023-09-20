<?php
declare(strict_types=1);

namespace App\Console;

use Symfony\Component\Console\Event\ConsoleEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Console\ConsoleEvents;

class ConsoleListener implements EventSubscriberInterface
{

    public function onTerminate(ConsoleEvent $event): void
    {

//            $event->getCommand()->setCode(232);

    }

    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleEvents::TERMINATE => 'onTerminate'
        ];
    }
}