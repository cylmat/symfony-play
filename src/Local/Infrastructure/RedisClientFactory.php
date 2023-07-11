<?php

namespace App\Local\Infrastructure;

use App\AppBundle\Infrastructure\NullClient;
use App\Local\Domain\RedisClientInterface;
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
        $client = $this->redisClient ? new RedisClient($this->redisClient) : new NullClient();

        try {
            $client->connect(); // @phpstan-ignore-line: Undefined method
        } catch (Throwable $exception) {
            return new NullClient();
        }

        return $client;
    }
}
