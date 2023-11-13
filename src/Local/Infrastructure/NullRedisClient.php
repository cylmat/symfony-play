<?php

declare(strict_types=1);

namespace App\Local\Infrastructure;

final class NullRedisClient implements RedisClientInterface
{
    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
    }
}
