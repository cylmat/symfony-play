<?php

namespace App\Domain\Service\Encryption;

class BcryptEncryption implements EncryptionInterface
{
    public function encrypt(string $value): string
    {
        return \password_hash($value, PASSWORD_BCRYPT);
    }
}
