<?php

namespace App\Test\ApiResource;

use App\ApiResource\RandomApiController;
use PHPUnit\Framework\TestCase;

/** @group functional */
final class RandomApiControllerTest extends TestCase
{
    private RandomApiController $randomApiController;

    protected function setUp(): void
    {
        $this->randomApiController = new RandomApiController();
    }

    public function testGetRandomIntAction(): void
    {
        $this->markTestIncomplete();
    }
}
