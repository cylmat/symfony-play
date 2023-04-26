<?php

namespace App\Test\AppBundle\Controller\Admin;

use App\AppBundle\Controller\Admin\LogController;
use PHPUnit\Framework\TestCase;

/** @group functional */
final class LogControllerTest extends TestCase
{
    private LogController $logController;

    protected function setUp(): void
    {
        $this->logController = new LogController();
    }

    public function testGetEntityFqcn(): void
    {
        $this->markTestIncomplete();
    }

    public function testConfigureActions(): void
    {
        $this->markTestIncomplete();
    }

    public function testFlush(): void
    {
        $this->markTestIncomplete();
    }
}
