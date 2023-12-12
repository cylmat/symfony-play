<?php

declare(strict_types=1);

namespace App\Data\Infrastructure\Redis;

use Predis\Client;
use Throwable;

final class RedisClientFactory
{
    public function __construct(
        private readonly ?Client $redisClient = null // @snc_redis
    ) {
    }

    /**
     * @infection-ignore-all
     * @codeCoverageIgnore
     */
    public function __invoke(): RedisClientInterface
    {
        $client = $this->redisClient ? new RedisClient($this->redisClient) : new RedisClientNull();

        try {
            $client->connect(); // @phpstan-ignore-line: Undefined method
        } catch (Throwable $exception) {
            return new RedisClientNull();
        }

        return $client;
    }
}
