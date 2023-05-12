<?php

namespace App\Test\AppBundle\Application\Service;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Infrastructure\AppDoctrine;
use App\AppBundle\Application\Service\Logger;
use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    public function testAddRecord(): void
    {
        $log = (new Log())
            ->setChannel('default')
            ->setLevel('debug')
            ->setMessage('Test')
        ;

        $doctrine = $this->createMock(AppDoctrine::class);
        $doctrine
            ->expects($this->once())
            ->method('persist')
            ->with($log)
        ;
        $doctrine
            ->expects($this->once())
            ->method('flush');
        $logger = new Logger($doctrine);
        
        $this->assertTrue($logger->addRecord(100, 'Test'));
    }
}
