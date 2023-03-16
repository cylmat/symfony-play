<?php

namespace App\Test\AppBundle\DependencyInjection;

use App\AppBundle\DependencyInjection\AppExtension;
use PHPUnit\Framework\TestCase;

final class AppExtensionTest extends TestCase
{
    private AppExtension $appExtension;

    protected function setUp(): void
    {
        $this->appExtension = new AppExtension();
    }

    public function testPrepend(): void
    {
        $this->markTestIncomplete();
    }

    public function testLoad(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetConfiguration(): void
    {
        $this->markTestIncomplete();
    }
}
