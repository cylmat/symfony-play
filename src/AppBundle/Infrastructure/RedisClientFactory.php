<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\AppClientInterface;
use Predis\Client as PredisClient;
use Throwable;

class RedisClientFactory
{
    public function __construct(
        private ?string $redisUrl
    ) {
    }

    /**
     * @infection-ignore-all
     * @codeCoverageIgnore
     * @todo Use config instead of $redisUrl
     */
    public function __invoke(): AppClientInterface
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
