<?php

namespace App\Test\AppBundle\Application\Controller;

use App\AppBundle\Application\Controller\HomeController;
use PHPUnit\Framework\TestCase;

/** @group functional */
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
