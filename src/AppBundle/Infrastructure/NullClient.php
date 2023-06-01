<?php

namespace App\AppBundle\Infrastructure;

use App\Local\Domain\RedisClientInterface;

class NullClient implements RedisClientInterface
{
    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
    }
}
