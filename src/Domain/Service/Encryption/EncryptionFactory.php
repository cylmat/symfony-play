<?php

namespace App\Domain\Service\Encryption;

class EncryptionFactory
{
    public function create(): EncryptionInterface
    {
        return new BcryptEncryption();
    }
}
