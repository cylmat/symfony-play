<?php

namespace App\Local\Infrastructure;

use Predis\Client;
use Throwable;

class RedisClientFactory
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
        $client = $this->redisClient ? new RedisClient($this->redisClient) : new NullRedisClient();

        try {
            $client->connect(); // @phpstan-ignore-line: Undefined method
        } catch (Throwable $exception) {
            return new NullRedisClient();
        }

        return $client;
    }
}
