<?php

namespace App\Local\Infrastructure;

use App\Local\Domain\RedisClientInterface;
use Predis\Client as PredisClient;

/* @see https://github.com/predis/predis/wiki */
class RedisClient implements RedisClientInterface
{
    private PredisClient $predis;

    public function __construct(
        string $redisUrl
    ) {
        $this->predis = new PredisClient($redisUrl);
    }

    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
        return $this->predis->{$name}(...$arguments);
    }
}
