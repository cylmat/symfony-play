<?php

namespace App\SampleBundle\Domain\Service;

/**
 * Use with LoggerTrait.
 */
interface LoggerAwareInterface
{
    public function setLogger(LoggerInterface $logger): self;

    public function getLogger(string $channel = null): LoggerInterface;
}
