<?php

namespace App\Test\AppBundle\Entity;

use App\AppBundle\Entity\Log;
use PHPUnit\Framework\TestCase;

final class LogTest extends TestCase
{
    private Log $log;

    protected function setUp(): void
    {
        $this->log = new Log();
    }

    public function testGetId(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetLevel(): void
    {
        $this->markTestIncomplete();
    }

    public function testSetLevel(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetChannel(): void
    {
        $this->markTestIncomplete();
    }

    public function testSetChannel(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetMessage(): void
    {
        $this->markTestIncomplete();
    }

    public function testSetMessage(): void
    {
        $this->markTestIncomplete();
    }
}
