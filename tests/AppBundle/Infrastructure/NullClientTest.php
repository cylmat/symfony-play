<?php

namespace App\Test\AppBundle\Infrastructure;

use App\AppBundle\Infrastructure\NullClient;
use PHPUnit\Framework\TestCase;

final class NullClientTest extends TestCase
{
    private NullClient $nullClient;

    protected function setUp(): void
    {
        $this->nullClient = new NullClient();
    }

    public function test__call(): void
    {
        $this->assertNull($this->nullClient->whatever('something'));
    }
}
