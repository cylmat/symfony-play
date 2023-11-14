<?php

declare(strict_types=1);

namespace App\AppBundle\Domain\Message;

final class LogMessage implements MessageInterface
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
