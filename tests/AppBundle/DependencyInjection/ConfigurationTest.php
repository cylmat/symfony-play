<?php

namespace App\Test\AppBundle\DependencyInjection;

use App\AppBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigurationTest.
 *
 * @covers \App\AppBundle\DependencyInjection\Configuration
 */
final class ConfigurationTest extends TestCase
{
    private Configuration $configuration;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->configuration = new Configuration();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->configuration);
    }

    public function testGetConfigTreeBuilder(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
