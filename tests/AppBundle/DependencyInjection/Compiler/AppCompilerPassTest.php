<?php

namespace App\Test\AppBundle\DependencyInjection\Compiler;

use App\AppBundle\DependencyInjection\Compiler\AppCompilerPass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class AppCompilerPassTest extends TestCase
{
    private ContainerBuilder|MockObject $container;
    private AppCompilerPass $appCompilerPass;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerBuilder::class);
        $this->appCompilerPass = new AppCompilerPass();
    }

    public function testProcess(): void
    {
        $this->assertNull($this->appCompilerPass->process($this->container));
    }
}
