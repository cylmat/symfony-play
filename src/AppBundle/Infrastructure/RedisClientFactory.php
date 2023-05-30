<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\AppClientInterface;
use App\AppBundle\Infrastructure\RedisClient;
use Throwable;

class RedisClientFactory
{
    public function __construct(
        private readonly ?string $redisUrl = null
    ) {
    }

    /**
     * @infection-ignore-all
     * @codeCoverageIgnore
     * @todo Use config instead of $redisUrl
     */
    public function __invoke(): AppClientInterface
    {
        $client = $this->redisUrl ? new RedisClient($this->redisUrl) : new NullClient();

        try {
            /** @var PredisClient $client */
            $client->connect();
        } catch (Throwable $exception) {
            return new NullClient();
        }

        return $client;
    }
}
