<?php

namespace App\Test\AppBundle\Infrastructure;

use App\AppBundle\Infrastructure\Doctrine;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class DoctrineTest extends TestCase
{
    private Doctrine $appDoctrine;
    private ManagerRegistry|MockObject $doctrine;

    protected function setUp(): void
    {
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->appDoctrine = new Doctrine($this->doctrine);
    }

    public function testPersist(): void
    {
        $this->markTestIncomplete();
    }

    public function testFlush(): void
    {
        $this->markTestIncomplete();
    }
}
