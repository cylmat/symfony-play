<?php

namespace App\Test\AppData\Domain\Manager;

use App\AppData\Domain\Manager\AppEntityRegistry;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AppEntityRegistryTest extends TestCase
{
    private AppEntityRegistry $appEntityRegistry;
    private ManagerRegistry|MockObject $doctrineRegistry;
    private iterable $persistanceEntityRegistry;

    protected function setUp(): void
    {
        $this->doctrineRegistry = $this->createMock(ManagerRegistry::class);
        $this->persistanceEntityRegistry = [];
        $this->appEntityRegistry = new AppEntityRegistry($this->doctrineRegistry, $this->persistanceEntityRegistry);
    }

    public function testGetDoctrineRegistry(): void
    {
        $this->markTestIncomplete();
    }

    public function testPersist(): void
    {
        $this->markTestIncomplete();
    }
}
