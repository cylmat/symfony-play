<?php

namespace App\Test\AppBundle\Service;

use App\AppBundle\Infrastructure\AppDoctrine;
use App\AppBundle\Service\Logger;
use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    public function testAddRecord(): void
    {
        $doctrine = $this->prophesize(AppDoctrine::class);
        $logger = new Logger($doctrine->reveal());
        
        $this->assertNull($logger->addRecord(100, 'test'));
    }
}
