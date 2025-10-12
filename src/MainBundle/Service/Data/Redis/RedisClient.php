<?php

declare(strict_types=1);

namespace App\MainBundle\Service\Data\Redis;

use App\MainBundle\Service\Data\ClientInterface;
use App\MainBundle\Service\Data\ClientNull;
use Predis\Client;

// Doc.

/** @see https://github.com/predis/predis/wiki */
final class RedisClient implements ClientInterface
{
    private mixed $client;

    /** @var object $redisClient Can be "Predis" or other Redis client */
    public function __construct(?object $redisClient = null)
    {
        $this->init($redisClient);
    }

    public function __call(string $name, mixed $arguments): mixed
    {
        return $this->client->{$name}(...$arguments);
    }

    private function init(?object $redisClient): void
    {
        try {
            $this->client = $redisClient ?: new ClientNull();
            $this->client->connect();
        } catch (\Throwable) {
            $this->client = new ClientNull();
        }
    }
}
