<?php

namespace App\Test\ApiResource\Application\Controller;

use App\ApiResource\Application\RandomApiAction;
use App\AppBundle\Application\Common\AppRequest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @group integration */
final class RandomApiActionTest extends KernelTestCase
{
    private RandomApiAction $randomApiAction;

    protected function setUp(): void
    {
        $this->randomApiAction = static::getContainer()->get(RandomApiAction::class);
    }

    public function testExecute(): void
    {
        $data = $this->randomApiAction->execute(new AppRequest());

        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('format', $data);
        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('random_int', $data['data']);
        $this->assertArrayHasKey('random_redis', $data['data']);
    }
}
