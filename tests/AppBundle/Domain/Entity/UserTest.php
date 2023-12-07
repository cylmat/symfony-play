<?php

namespace App\Test\AppBundle\Domain\Entity;

use App\AppBundle\Domain\Entity\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private User $appUser;

    protected function setUp(): void
    {
        $this->appUser = new User();
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
