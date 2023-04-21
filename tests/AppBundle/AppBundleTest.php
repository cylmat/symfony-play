<?php

namespace App\Test\AppBundle;

use App\AppBundle\AppBundle;
use App\AppBundle\DependencyInjection\AppExtension;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class AppBundleTest extends TestCase
{
    private AppBundle $appBundle;

    protected function setUp(): void
    {
        $this->appBundle = new AppBundle();
    }

    protected function testBuild(): void
    {
        $container = $this->prophesize(ContainerBuilder::class);
        $container->addCompilerPass(Argument::any())->shouldBeCalled();
        $this->appBundle->build($container->reveal());
    }

    public function testGetContainerExtension(): void
    {
        $this->assertInstanceOf(AppExtension::class, $this->appBundle->getContainerExtension());
    }
}
