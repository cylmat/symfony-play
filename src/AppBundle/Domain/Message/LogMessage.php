<?php

namespace App\AppBundle\Domain\Message;

class LogMessage
{
    public function __construct(
        private readonly array $message
    ) {
    }
}
