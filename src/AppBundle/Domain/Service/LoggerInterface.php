<?php

namespace App\AppBundle\Domain\Service;

use Psr\Log\LoggerInterface as PsrLoggerInterface;

/**
 * Implements a simple logger
 */
interface LoggerInterface extends PsrLoggerInterface
{
    public function setChannel(string $channel): self;
}
