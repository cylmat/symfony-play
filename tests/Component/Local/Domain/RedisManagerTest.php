<?php

namespace App\Test\Local\Domain;

use App\AppBundle\Domain\AppClientInterface;
use App\Local\Domain\RedisManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

final class RedisManagerTest extends TestCase
{
    use ProphecyTrait;

    private RedisManager $redisManager;
    private AppClientInterface|MockObject $redisClient;

    protected function setUp(): void
    {
        $this->redisClient = $this->getMockBuilder(AppClientInterface::class)
            ->addMethods(['eval'])
            ->getMock();

        $this->redisManager = new RedisManager($this->redisClient);
    }

    public function testGetLuaRandomInt(): void
    {
        $this->redisClient
            ->expects($this->once())
            ->method('eval')
            ->with('math.randomseed(ARGV[1]); return math.random(0, 100)', 0, $this->anything())
        ;
        $this->assertEquals(0, $this->redisManager->getLuaRandomInt());
    }
}
