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
        private RedisClientFactory $redisClientFactory
    ) {
        $this->redisClient = $redisClientFactory();
    }

    /**
     * @todo REMOVE TEST !!!
     */
    public function test()
    {
        $this->redisClient->set('y', 'b');
    }
}
