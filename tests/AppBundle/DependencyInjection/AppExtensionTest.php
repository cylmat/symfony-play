<?php

namespace App\Test\AppBundle\DependencyInjection;

use App\AppBundle\DependencyInjection\AppExtension;
use PHPUnit\Framework\TestCase;

/**
 * Class AppExtensionTest.
 *
 * @covers \App\AppBundle\DependencyInjection\AppExtension
 */
final class AppExtensionTest extends TestCase
{
    private AppExtension $appExtension;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->appExtension = new AppExtension();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->appExtension);
    }

    public function testPrepend(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testLoad(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetConfiguration(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
