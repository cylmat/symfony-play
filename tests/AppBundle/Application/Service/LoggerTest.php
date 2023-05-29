<?php

namespace App\Test\AppBundle\Application\Service;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Infrastructure\AppDoctrine;
use App\AppBundle\Application\Service\Logger;
use Monolog\Level;
use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    private AppDoctrine $doctrine;

    protected function setUp(): void
    {
        $this->doctrine = $this->createMock(AppDoctrine::class);
    }

    public function testDefault(): void
    {
        $logger = new Logger($this->doctrine);
        
        $this->assertEquals([], $logger->getHandlers());
        $this->assertEquals([], $logger->getProcessors());
    }

    public function testSetChannel(): void
    {
        $logger = new Logger($this->doctrine);

        $this->assertInstanceOf(Logger::class, $logger->setChannel('test'));
    }

    /** @dataProvider addRecordProvider */
    public function testAddRecord($level): void
    {
        $log = (new Log())
            ->setChannel('default')
            ->setLevel('debug')
            ->setMessage('Test')
        ;

        $this->doctrine
            ->expects($this->once())
            ->method('persist')
            ->with($log, true)
        ;

        $logger = new Logger($this->doctrine);
        
        $this->assertTrue($logger->addRecord($level, 'Test'));
    }

    public function addRecordProvider(): iterable
    {
        yield 'level' => [Level::Debug];
        yield 'int' => [100];
    }
}
