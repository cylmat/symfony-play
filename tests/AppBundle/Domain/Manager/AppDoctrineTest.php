<?php

namespace App\Test\AppBundle\Domain\Manager;

use App\AppBundle\Domain\Manager\AppDoctrine;
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
        $this->appDoctrine = new AppDoctrine($this->doctrine, 'dev', []);
    }

    public function testPersistNoReplicate(): void
    {
        $this->doctrine
            ->method('getManagerForClass')
            ->with(\stdClass::class)
            ->willReturn($this->objectManager);

        $this->objectManager
            ->expects($this->once())
            ->method('persist')
            ->with(new \stdClass());

        $this->appDoctrine->persist(new \stdClass());
    }

    public function testWithReplicate(): void
    {
        $replicateEntities = [
            \stdClass::class => [
                \stdClass::class,
                \stdClass::class,
            ]
        ];

        $this->doctrine
            ->method('getManagerForClass')
            ->with(\stdClass::class)
            ->willReturn($this->objectManager);

        $this->objectManager
            ->expects($this->exactly(3))
            ->method('persist')
            ->with($this->isInstanceOf(\stdClass::class));

        $appDoctrine = new AppDoctrine($this->doctrine, 'dev', $replicateEntities);
        $appDoctrine->persist(new \stdClass(), true);
    }
}
