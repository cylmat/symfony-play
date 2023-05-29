<?php

namespace App\Test\AppBundle\Domain\Entity;

use App\AppBundle\Domain\Entity\Log;
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
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetLevel(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetChannel(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetChannel(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetMessage(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetMessage(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
