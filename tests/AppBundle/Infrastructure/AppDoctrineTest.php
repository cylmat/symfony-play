<?php

namespace App\Test\AppBundle\Infrastructure;

use App\AppBundle\Infrastructure\AppDoctrine;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AppDoctrineTest extends TestCase
{
    private AppDoctrine $appDoctrine;
    private ObjectManager|MockObject $objectManager;
    private ManagerRegistry|MockObject $doctrine;

    protected function setUp(): void
    {
        $this->objectManager = $this->createMock(ObjectManager::class);
        $this->doctrine = $this->createStub(ManagerRegistry::class);
        $this->doctrine
            ->method('getManager')
            ->willReturn($this->objectManager);
        $this->appDoctrine = new AppDoctrine($this->doctrine);
    }

    public function testPersist(): void
    {
        $this->objectManager
            ->expects($this->once())
            ->method('persist')
            ->with($this->anything());
        $this->appDoctrine->persist(new \stdClass());
    }

    public function testFlush(): void
    {
        $this->objectManager
            ->expects($this->once())
            ->method('flush');
        $this->appDoctrine->flush();
    }
}
