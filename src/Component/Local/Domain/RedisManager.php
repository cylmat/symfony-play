<?php

namespace App\Local\Domain;

use App\AppBundle\Infrastructure\NullClient;
use App\AppBundle\Infrastructure\RedisClientFactory;

/* @see https://app.redislabs.com */
/* @see https://github.com/predis/predis/wiki */
class RedisManager
{
    private NullClient|\Predis\Client $redisClient;

    public function __construct(
        RedisClientFactory $redisClientFactory
    ) {
        $this->redisClient = $redisClientFactory();
    }

    public function getClient(): NullClient|\Predis\Client
    {
        return $this->redisClient;
    }
}
