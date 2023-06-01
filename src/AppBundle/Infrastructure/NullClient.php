<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\RedisClientInterface;

class NullClient implements RedisClientInterface
{
    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
    }
}
