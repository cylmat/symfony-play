<?php

namespace App\Encrypt\Domain\Service\Encryption;

use App\Encrypt\Domain\Model\EncryptedData;

class BcryptEncryption implements EncryptionInterface
{
    public function encrypt(string $value, array $options): EncryptedData
    {
        return new EncryptedData(\password_hash($value, PASSWORD_BCRYPT, $options));
    }
}
