<?php

namespace App\AppBundle\Domain\Contracts;

/** @see Symfony\Component\Messenger\Stamp\StampInterface\MessageBusInterface */
interface MessageBusInterface
{
    public function dispatch(object $message, array $stamps = []): object;
}
