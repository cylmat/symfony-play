<?php

namespace App\Test\AppBundle\Infrastructure;

use App\AppBundle\Infrastructure\NullClient;
use App\Local\Infrastructure\RedisClientFactory;
use PHPUnit\Framework\TestCase;

final class RedisClientFactoryTest extends TestCase
{
    /* Always NullClient for tests */
    public function testInvoke(): void
    {
        $redis_url = 'whatever';
        $redisClientFactory = new RedisClientFactory($redis_url);

        $this->assertInstanceOf(NullClient::class, $redisClientFactory());
    }
}
