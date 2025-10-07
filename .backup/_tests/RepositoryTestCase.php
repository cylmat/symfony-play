<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

abstract class RepositoryTestCase extends TestCase
{
    protected EntityManager|MockObject $em;
    protected ClassMetadata|MockObject $meta;
    protected ManagerRegistry|MockObject $registry;

    protected function setUp(): void
    {
        $this->initManager();
    }

    protected function initManager(): void
    {
        $this->meta = $this->createMock(ClassMetadata::class);

        $this->em = $this->createMock(EntityManager::class);
        $this->em
            ->method('getClassMetadata')
            ->willReturn($this->meta);

        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->registry
            ->method('getManagerForClass')
            ->willReturn($this->em);
    }
}
