<?php

namespace App\AppBundle\Infrastructure;

use App\Local\Infrastructure\RedisClientInterface;

class NullClient implements RedisClientInterface /** @todo appbundle don't depends components */
{
    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
    }
}
