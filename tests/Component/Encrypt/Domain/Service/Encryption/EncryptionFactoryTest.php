<?php

namespace App\Tests\Encrypt\Domain\Service\Encryption;

use App\Encrypt\Domain\Exception\AlgorithmNotFoundException;
use App\Encrypt\Domain\Service\Encryption\BcryptEncryption;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;
use PHPUnit\Framework\TestCase;

final class EncryptionFactoryTest extends TestCase
{
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
