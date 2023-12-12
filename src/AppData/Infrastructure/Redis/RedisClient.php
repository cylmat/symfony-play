<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Redis;

use Predis\Client as PredisClient;

/** @see https://github.com/predis/predis/wiki */
final class RedisClient implements RedisClientInterface
{
    public function __construct(
        private readonly PredisClient $redisClient,
    ) {
    }

    public function __call(string $name, mixed $arguments): mixed
    {
        return $this->redisClient->{$name}(...$arguments);
    }
}
