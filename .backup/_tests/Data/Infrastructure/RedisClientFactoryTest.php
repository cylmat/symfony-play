<?php

namespace App\Test\AppData\Infrastructure;

use App\AppData\Infrastructure\NullClient;
use App\AppData\Infrastructure\RedisClientFactory;
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
