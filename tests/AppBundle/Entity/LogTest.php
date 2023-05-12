<?php

namespace App\Test\AppBundle\Entity;

use App\AppBundle\Domain\Entity\Log;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

final class LogTest extends TestCase
{
    private Log $log;

    protected function setUp(): void
    {
        $this->log = new Log();
    }

    public function testData(): void
    {
        $this->log->setChannel('channel');
        $this->log->setLevel('debug');
        $this->log->setMessage('msg');

        $this->assertSame(
            [
                null,
                'channel',
                LogLevel::DEBUG,
                'msg',
            ],
            [
                $this->log->getId(),
                $this->log->getChannel(),
                $this->log->getLevel(),
                $this->log->getMessage(),
            ]
        );
    }
}
