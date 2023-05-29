<?php

namespace App\Test\AppBundle\Infrastructure\Repository;

use App\AppBundle\Infrastructure\Repository\AppUserRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AppUserRepositoryTest extends TestCase
{
    private AppUserRepository $appUserRepository;
    private ManagerRegistry|MockObject $registry;

    protected function setUp(): void
    {
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->appUserRepository = new AppUserRepository($this->registry);
    }

    public function testAdd(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testRemove(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testUpgradePassword(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
