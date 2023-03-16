<?php

namespace App\Test\AppBundle;

use App\AppBundle\AppBundle;
use PHPUnit\Framework\TestCase;

final class AppBundleTest extends TestCase
{
    private AppBundle $appBundle;

    protected function setUp(): void
    {
        $this->appBundle = new AppBundle();
    }

    public function testGetContainerExtension(): void
    {
        $this->markTestIncomplete();
    }
}
