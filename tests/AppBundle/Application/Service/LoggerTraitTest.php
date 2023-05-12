<?php

namespace App\Test\AppBundle\Application\Service;

use App\AppBundle\Application\Service\LoggerInterface;
use App\AppBundle\Application\Service\LoggerTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class LoggerTraitTest extends TestCase
{
    private LoggerTrait|MockObject $loggerTrait;
    private LoggerInterface|MockObject $logger;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        
        $this->loggerTrait = $this->getMockBuilder(LoggerTrait::class)
            ->setConstructorArgs([])
            ->getMockForTrait()
        ;
    }

    public function testGetDefaultLoggerException(): void
    {
        $this->expectException(\Error::class);
        $this->loggerTrait->getLogger();
    }

    public function testGetSetLogger(): void
    {
        $this->loggerTrait->setLogger($this->logger);
        $this->assertEquals($this->logger, $this->loggerTrait->getLogger());
    }
}
