<?php

namespace App\Test\Local\Domain;

use App\AppBundle\Infrastructure\NullClient;
use App\AppBundle\Infrastructure\RedisClientFactory;
use App\Local\Domain\RedisManager;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class RedisManagerTest extends TestCase
{
    use ProphecyTrait;

    private RedisManager $redisManager;
    private RedisClientFactory|ObjectProphecy $redisClientFactory;

    protected function setUp(): void
    {
        $this->redisClientFactory = $this->prophesize(RedisClientFactory::class);
        $this->redisClientFactory->__invoke()->willReturn(new NullClient());
        $this->redisManager = new RedisManager($this->redisClientFactory->reveal());
    }

    public function testGetClient(): void
    {
        $this->assertEquals(new NullClient(), $this->redisManager->getClient());
    }
}
