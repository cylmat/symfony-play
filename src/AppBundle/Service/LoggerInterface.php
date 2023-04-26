<?php

namespace App\AppBundle\Service;

use Psr\Log\LoggerInterface as LogLoggerInterface;

interface LoggerInterface extends LogLoggerInterface
{
    public function setChannel(string $channel): self;
}
