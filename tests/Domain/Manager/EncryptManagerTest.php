<?php

namespace App\Tests\Domain\Manager;

use App\Domain\Manager\EncryptManager;
use App\Domain\Model\EncryptedData;
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
            ->willReturn($data = new EncryptedData('$2y$12x'));

        $factory = $this->createMock(EncryptionFactory::class);
        $factory
            ->method('create')
            ->with('bcrypt')
            ->willReturn($bcrypt);
        $manager = new EncryptManager($factory);

        $this->assertSame($data->getValue(), $manager->encryptValue('bcrypt', 'testvalue', []));
    }
}
