<?php

namespace App\AppBundle\Domain\Message;

class LogMessage implements MessageInterface
{
    public function __construct(
        public readonly array $message
    ) {
    }

    public function __get(string $key): mixed
    {
        return $this->message[$key];
    }
}
