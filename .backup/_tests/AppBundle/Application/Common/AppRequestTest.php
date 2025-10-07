<?php

namespace App\Tests\AppBundle\Application\Common;

use PHPUnit\Framework\TestCase;

final class AppRequestTest extends TestCase
{
    public function testData(): void
    {
        $request = new AppRequest(['key' => 'value']);
        $this->assertSame('value', $request->key);

        $request = (new AppRequest)
            ->setMyValue('is val');
        $this->assertSame('is val', $request->myValue);
    }
}
