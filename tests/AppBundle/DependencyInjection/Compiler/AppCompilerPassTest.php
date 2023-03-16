<?php

namespace App\Test\AppBundle\DependencyInjection\Compiler;

use App\AppBundle\DependencyInjection\Compiler\AppCompilerPass;
use PHPUnit\Framework\TestCase;

final class AppCompilerPassTest extends TestCase
{
    private AppCompilerPass $appCompilerPass;

    protected function setUp(): void
    {
        $this->appCompilerPass = new AppCompilerPass();
    }

    public function testProcess(): void
    {
        $this->markTestIncomplete();
    }
}
