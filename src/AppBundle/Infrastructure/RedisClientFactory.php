<?php

namespace App\AppBundle\Infrastructure;

use Predis\Client as PredisClient;
use Throwable;

class RedisClientFactory
{
    public function __construct(
        private ?string $redisUrl
    ) {
    }

    /** @infection-ignore-all */
    public function __invoke(): NullClient|PredisClient
    {
        $client = $this->redisUrl ? new PredisClient($this->redisUrl) : new NullClient();

        try {
            /** @var PredisClient $client */
            $client->connect();
        } catch (Throwable $exception) {
            return new NullClient();
        }

        return $client;
    }
}
