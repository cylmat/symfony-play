<?php

namespace App\AppBundle\Infrastructure;

class RedisClientFactory
{
    public function __construct(
        private ?string $redis_url
    ) {
    }

    public function __invoke(): NullClient|\Predis\Client
    {
        return $this->redis_url ? new \Predis\Client($this->redis_url) : new NullClient();
    }
}
