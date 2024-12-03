<?php

namespace App\SampleBundle\Infrastructure\Service;

use App\SampleBundle\Domain\MessageBusInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface as SymfonyMessageBusInterface;

final class MessageBus implements MessageBusInterface
{
    public function __construct(
        /** @todo use tagged iterator */
        private readonly SymfonyMessageBusInterface $symfonyMessageBus,  // messenger.bus.default
    ) {
    }

    public function dispatch(object $message, array $stamps = []): Envelope
    {
        return $this->symfonyMessageBus->dispatch($message, $stamps);
    }
}
