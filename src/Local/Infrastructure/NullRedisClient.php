<?php

namespace App\Local\Infrastructure;

class NullRedisClient implements RedisClientInterface
{
    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
    }
}
