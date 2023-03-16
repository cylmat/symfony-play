<?php

namespace App\Test\AppBundle\Repository;

use App\AppBundle\Repository\LogRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class LogRepositoryTest extends TestCase
{
    private LogRepository $logRepository;
    private ManagerRegistry|MockObject $registry;

    protected function setUp(): void
    {
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->logRepository = new LogRepository($this->registry);
    }

    public function testSave(): void
    {
        $this->markTestIncomplete();
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
    }
}
