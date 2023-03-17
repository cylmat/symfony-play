<?php

namespace App\Test\AppBundle\DependencyInjection;

use App\AppBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

final class ConfigurationTest extends TestCase
{
    private Configuration $configuration;

    protected function setUp(): void
    {
        $this->configuration = new Configuration();
    }

    public function testGetConfigTreeBuilder(): void
    {
        $this->assertInstanceOf(TreeBuilder::class, $this->configuration->getConfigTreeBuilder());
    }
}
