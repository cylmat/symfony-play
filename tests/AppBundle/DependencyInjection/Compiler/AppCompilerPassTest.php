<?php

namespace App\Test\AppBundle\DependencyInjection\Compiler;

use App\AppBundle\DependencyInjection\Compiler\AppCompilerPass;
use PHPUnit\Framework\TestCase;

/**
 * Class AppCompilerPassTest.
 *
 * @covers \App\AppBundle\DependencyInjection\Compiler\AppCompilerPass
 */
final class AppCompilerPassTest extends TestCase
{
    private AppCompilerPass $appCompilerPass;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->appCompilerPass = new AppCompilerPass();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->appCompilerPass);
    }

    public function testProcess(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
