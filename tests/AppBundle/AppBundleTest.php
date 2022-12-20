<?php

namespace App\Test\AppBundle;

use App\AppBundle\AppBundle;
use PHPUnit\Framework\TestCase;

/**
 * Class AppBundleTest.
 *
 * @covers \App\AppBundle\AppBundle
 */
final class AppBundleTest extends TestCase
{
    private AppBundle $appBundle;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->appBundle = new AppBundle();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->appBundle);
    }

    public function testBuild(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetContainerExtension(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
