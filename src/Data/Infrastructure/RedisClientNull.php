<?php

declare(strict_types=1);

namespace App\Data\Infrastructure;

final class RedisClientNull implements RedisClientInterface
{
    public function __call(string $name, mixed $arguments): mixed
    {
        return null;
    }
}
