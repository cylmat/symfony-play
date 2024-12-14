<?php

namespace App\SampleBundle\Domain;

/** @see Symfony\Component\Messenger\Stamp\StampInterface\MessageBusInterface */
interface MessageBusInterface
{
    public function dispatch(object $message, array $stamps = []): object;
}
