<?php

namespace App\Tests\Domain\Manager;

use App\Domain\Manager\EncryptManager;
use App\Domain\Service\Encryption\BcryptEncryption;
use App\Domain\Service\Encryption\EncryptionFactory;
use PHPUnit\Framework\TestCase;

class EncryptManagerTest extends TestCase
{
    public function testEncryptValue(): void
    {
        $bcrypt = $this->createMock(BcryptEncryption::class);
        $bcrypt
            ->method('encrypt')
            ->with('testvalue', [])
            ->willReturn('$2y$12x');

        $factory = $this->createMock(EncryptionFactory::class);
        $factory
            ->method('create')
            ->with('bcrypt')
            ->willReturn($bcrypt);
        $manager = new EncryptManager($factory);

        $this->assertSame('$2y$12x', $manager->encryptValue('bcrypt', 'testvalue', []));
    }
}
