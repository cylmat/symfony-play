<?php

declare(strict_types=1);

namespace App\Data\Infrastructure;

final class NullRedisClient implements RedisClientInterface
{
    /** @phpstan-ignore-next-line: no return type */
    public function __call(string $name, mixed $arguments)
    {
    }
}
