<?php

namespace App\Test\AppBundle\DependencyInjection;

use App\AppBundle\DependencyInjection\AppExtension;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class AppExtensionTest extends TestCase
{
    private ContainerBuilder|MockObject $container;
    private AppExtension $appExtension;

    protected function setUp(): void
    {
        $this->container = $this->createStub(ContainerBuilder::class);
        $this->appExtension = new AppExtension();
    }

    public function testPrepend(): void
    {
        $this->assertNull($this->appExtension->prepend($this->container));
    }

    public function testLoad(): void
    {
        $this->assertNull(
            $this->appExtension->load(['config'], $this->container)
        );
    }

    public function testGetConfiguration(): void
    {
        $this->assertNull(
            $this->appExtension->getConfiguration(['config'], $this->container)
        );
    }
}
