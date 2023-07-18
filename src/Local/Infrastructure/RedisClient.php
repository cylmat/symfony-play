<?php

namespace App\Local\Infrastructure;

use Predis\Client as PredisClient;

/** @see https://github.com/predis/predis/wiki */
class RedisClient implements RedisClientInterface
{
    public function __construct(
        private readonly PredisClient $redisClient
    ) {
    }

    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
        return $this->redisClient->{$name}(...$arguments);
    }
}
