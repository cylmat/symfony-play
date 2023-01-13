<?php

namespace App\Tests\AppBundle\Common;

use App\AppBundle\Common\AppRequest;
use PHPUnit\Framework\TestCase;

final class AppRequestTest extends TestCase
{
    public function testData(): void
    {
        $request = new AppRequest(['key' => 'value']);
        $this->assertSame('value', $request->key);
    }
}
