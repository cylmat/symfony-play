<?php

namespace App\Test\AppBundle\Infrastructure\Dbal;

use App\AppBundle\Infrastructure\Dbal\ConnectionWrapper;
use PHPUnit\Framework\TestCase;

final class ConnectionWrapperTest extends TestCase
{
    private ConnectionWrapper $connectionWrapper;

    protected function setUp(): void
    {
        //$this->connectionWrapper = new ConnectionWrapper();
    }

    public function testConnect(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
