<?php

namespace App\Test\AppBundle\DataCollector;

use App\AppBundle\DataCollector\AppDataCollector;
use PHPUnit\Framework\TestCase;

final class AppDataCollectorTest extends TestCase
{
    private AppDataCollector $appDataCollector;

    protected function setUp(): void
    {
        $this->appDataCollector = new AppDataCollector();
    }

    public function testCollect(): void
    {
        $this->markTestIncomplete();
    }

    public function testLateCollect(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetTemplate(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetData(): void
    {
        $this->markTestIncomplete();
    }
}
