<?php

namespace App\Application\Controller;

use App\Application\Controller\HomeController;
use PHPUnit\Framework\TestCase;

final class HomeControllerTest extends TestCase
{
    private HomeController $homeController;

    protected function setUp(): void
    {
        $this->homeController = new HomeController();
    }

    public function testIndex(): void
    {
        $this->markTestIncomplete();
    }
}
