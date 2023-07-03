<?php

namespace App\AppBundle\Domain\Message;

class LogMessage implements MessageInterface
{
    public function __construct(
        private readonly array $message
    ) {
    }
}
