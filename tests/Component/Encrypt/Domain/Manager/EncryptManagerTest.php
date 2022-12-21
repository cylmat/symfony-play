<?php

namespace App\Tests\Encrypt\Domain\Manager;

use App\Encrypt\Domain\Manager\EncryptManager;
use App\Encrypt\Domain\Model\EncryptedData;
use App\Encrypt\Domain\Service\Encryption\BcryptEncryption;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;
use PHPUnit\Framework\TestCase;

final class EncryptManagerTest extends TestCase
{
    private EncryptionFactory $encryptFactory;
    private EncryptManager $encryptManager;

    protected function setUp(): void
    {
        $this->encryptFactory = $this->createMock(EncryptionFactory::class);
        $this->encryptManager = new EncryptManager($this->encryptFactory);
    }

    public function testEncryptValue(): void
    {
        $bcrypt = $this->createMock(BcryptEncryption::class);
        $bcrypt
            ->method('encrypt')
            ->with('testvalue', [])
            ->willReturn($data = new EncryptedData('$2y$12x'));

        $this->encryptFactory
            ->method('create')
            ->with('bcrypt')
            ->willReturn($bcrypt);

        $this->assertSame($data->getValue(), $this->encryptManager->encryptValue('bcrypt', 'testvalue', []));
    }
}
