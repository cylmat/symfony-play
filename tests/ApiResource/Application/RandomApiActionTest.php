<?php

namespace App\Test\ApiResource\Application\Controller;

use App\ApiResource\Application\RandomApiAction;
use App\AppBundle\Application\Common\AppRequest;
use App\Local\Domain\RedisManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/** @group integration */
final class RandomApiActionTest extends TestCase
{
    private RandomApiAction $randomApiAction;
    private RedisManager|MockObject $redisManager;

    protected function setUp(): void
    {
        $this->redisManager = $this->createMock(RedisManager::class);
        $this->randomApiAction = new RandomApiAction($this->redisManager);
    }

    public function testExecute(): void
    {
        $this->redisManager
            ->method('getLuaRandomInt')
            ->will($this->returnValue(9))
        ;

        $data = $this->randomApiAction->execute(new AppRequest());

        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('format', $data);
        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('random_int', $data['data']);
        $this->assertArrayHasKey('random_redis', $data['data']);
    }
}
