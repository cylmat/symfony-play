<?php

namespace App\Test\AppBundle\Controller\Admin;

use App\AppBundle\Controller\Admin\DashboardController;
use PHPUnit\Framework\TestCase;

/** @group functional */
final class DashboardControllerTest extends TestCase
{
    private DashboardController $dashboardController;

    protected function setUp(): void
    {
        $this->dashboardController = new DashboardController();
    }

    public function testIndex(): void
    {
        $this->markTestIncomplete();
    }

    public function testConfigureDashboard(): void
    {
        $this->markTestIncomplete();
    }

    public function testConfigureMenuItems(): void
    {
        $this->markTestIncomplete();
    }
}
