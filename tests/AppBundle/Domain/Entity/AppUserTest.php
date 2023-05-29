<?php

namespace App\Test\AppBundle\Domain\Entity;

use App\AppBundle\Domain\Entity\AppUser;
use PHPUnit\Framework\TestCase;

final class AppUserTest extends TestCase
{
    private AppUser $appUser;

    protected function setUp(): void
    {
        $this->appUser = new AppUser();
    }

    public function testGetId(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetUuid(): void
    {
        $this->markTestIncomplete();
    }

    public function testSetUuid(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetUserIdentifier(): void
    {
        $this->markTestIncomplete();
    }

    public function testGetRoles(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetRoles(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetPassword(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetPassword(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testEraseCredentials(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
