<?php

namespace App\Encrypt\Application\Listener;

use App\Encrypt\Domain\Model\EncryptedData;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\EnteredEvent;
use Symfony\Component\Workflow\Event\TransitionEvent;

class WorkflowListener implements EventSubscriberInterface
{
    /** @return string[] */
    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.encrypt.entered' => 'entered',
            'workflow.encrypt.transition' => 'transition',
        ];
    }

    public function entered(EnteredEvent $event): void
    {
        $event->getSubject() instanceof EncryptedData or throw new \RuntimeException("Event must be an instance of " . EncryptedData::class);
    }

    public function transition(TransitionEvent $event): void
    {
        $event->getSubject() instanceof EncryptedData or throw new \RuntimeException("Event must be an instance of " . EncryptedData::class);
    }
}
