<?php

namespace App\AppBundle\Service;

// Use with LoggerTrait !
interface LoggerAwareInterface
{
    public function setLogger(LoggerInterface $logger): self;

    public function getLogger(?string $channel = null): LoggerInterface;
}
