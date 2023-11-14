<?php

declare(strict_types=1);

namespace App\Data\Infrastructure;

use Predis\Client as PredisClient;

/** @todo put in "client" directory */
/** @see https://github.com/predis/predis/wiki */
final class RedisClient implements RedisClientInterface
{
    public function __construct(
        private readonly PredisClient $redisClient,
    ) {
    }

    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
        return $this->redisClient->{$name}(...$arguments);
    }
}
