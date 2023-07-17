<?php

namespace App\AppBundle\Domain\Service;

use Psr\Log\LoggerInterface as LogLoggerInterface;

interface LoggerInterface extends LogLoggerInterface
{
    public function setChannel(string $channel): self;
}
