<?php

namespace App\Test\AppBundle\Infrastructure\Repository;

use App\AppBundle\Infrastructure\Repository\LogRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class LogRepositoryTest extends TestCase
{
    private LogRepository $logRepository;
    private ManagerRegistry|MockObject $registry;
    private string $class;

    protected function setUp(): void
    {
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->class = '42';
        $this->logRepository = new LogRepository($this->registry, $this->class);
    }

    public function testSave(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testRemove(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
