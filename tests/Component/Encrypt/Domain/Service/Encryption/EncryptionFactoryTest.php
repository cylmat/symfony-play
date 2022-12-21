<?php

namespace App\Tests\Component\Encrypt\Domain\Service\Encryption;

use App\Component\Encrypt\Domain\Exception\AlgorithmNotFoundException;
use App\Component\Encrypt\Domain\Service\Encryption\BcryptEncryption;
use App\Component\Encrypt\Domain\Service\Encryption\EncryptionFactory;
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
        $this->assertInstanceOf(BcryptEncryption::class, $this->encryptionFactory->create('bcrypt'));
    }

    /** @expectException AlgorithmNotFoundException */
    public function testCreateFail(): void
    {
        $this->expectException(AlgorithmNotFoundException::class);
        $this->encryptionFactory->create('not');
    }
}
