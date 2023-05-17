<?php

namespace App\Test\Local\Domain;

use App\AppBundle\Infrastructure\NullClient;
use App\AppBundle\Infrastructure\RedisClientFactory;
use App\Local\Domain\RedisManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

final class RedisManagerTest extends TestCase
{
    use ProphecyTrait;

    private RedisManager $redisManager;
    private RedisClientFactory|ObjectProphecy $redisClientFactory;
    private NullClient|MockObject $client;

    protected function setUp(): void
    {
        $this->redisClientFactory = $this->prophesize(RedisClientFactory::class);
        $this->client = $this->createMock(NullClient::class);
        $this->redisClientFactory->__invoke()->willReturn($this->client);
        $this->redisManager = new RedisManager($this->redisClientFactory->reveal());
    }

    public function testGetClient(): void
    {
        $this->assertEquals($this->client, $this->redisManager->getClient());
    }

    public function testGetLuaRandomInt(): void
    {
        $this->assertEquals(0, $this->redisManager->getLuaRandomInt());
    }
}
