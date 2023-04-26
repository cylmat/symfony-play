<?php

namespace App\AppBundle\Service;

trait LoggerTrait
{
    // Used with LoggerAwareInterface !

    protected LoggerInterface $logger;

    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }

    public function getLogger(?string $channel = null): LoggerInterface
    {
        $logger = clone $this->logger;
        $channel ? $logger->setChannel($channel) : null;

        return $logger;
    }
}
