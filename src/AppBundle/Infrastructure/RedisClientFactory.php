<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\AppClientInterface;
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
            $client->connect(); // @phpstan-ignore-line: Undefined method
        } catch (Throwable $exception) {
            return new NullClient();
        }

        return $client;
    }
}
