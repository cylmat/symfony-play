<?php

namespace App\Domain\Service\Encryption;

use App\Domain\Service\Encryption\EncryptionFactory;
use PHPUnit\Framework\TestCase;

final class EncryptionFactoryTest extends TestCase
{
    private EncryptionFactory $encryptionFactory;

    protected function setUp(): void
    {
        $this->encryptionFactory = new EncryptionFactory();
    }

    public function testCreate(): void
    {
        $this->markTestIncomplete();
    }
}
