<?php

namespace App\Test\AppBundle\Repository;

use App\AppBundle\Entity\Log;
use App\AppBundle\Repository\LogRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class LogRepositoryTest extends TestCase
{
    private LogRepository $logRepository;
    protected EntityManager|MockObject $em;
    protected ClassMetadata|MockObject $meta;
    protected ManagerRegistry|MockObject $registry;

    protected function setUp(): void
    {
        $this->initManager();

        $this->logRepository = new LogRepository($this->registry);
    }

    protected function initManager()
    {
        $this->meta = $this->createMock(ClassMetadata::class);
        $this->em = $this->createMock(EntityManager::class);
        $this->em
            ->method('getClassMetadata')
            ->with(Log::class)
            ->willReturn($this->meta);
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->registry
            ->method('getManagerForClass')
            ->with(Log::class)
            ->willReturn($this->em);
            
    }

    public function testSave(): void
    {
        $log = new Log();

        $this->em
            ->expects($this->exactly(2))
            ->method('persist')
            ->with($log);

        $this->logRepository->save($log);

        // Flush
        $this->em
            ->expects($this->once())
            ->method('flush');

        $this->logRepository->save($log, true);
    }

    public function testRemove(): void
    {
        $log = new Log();

        $this->em
            ->expects($this->exactly(2))
            ->method('remove')
            ->with($log);

        $this->logRepository->remove($log);

        // Flush
        $this->em
            ->expects($this->once())
            ->method('flush');

        $this->logRepository->remove($log, true);
    }
}
