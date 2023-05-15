<?php

namespace App\Test\ApiResource\Application\Controller;

use App\ApiResource\Application\RandomApiAction;
use App\AppBundle\Application\Common\AppRequest;
use PHPUnit\Framework\TestCase;

/** @group integration */
final class RandomApiActionTest extends TestCase
{
    private RandomApiAction $randomApiAction;

    protected function setUp(): void
    {
        $this->randomApiAction = new RandomApiAction();
    }

    public function testExecute(): void
    {
        $data = $this->randomApiAction->execute(new AppRequest());

        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('format', $data);
        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('random_int', $data['data']);
    }
}
