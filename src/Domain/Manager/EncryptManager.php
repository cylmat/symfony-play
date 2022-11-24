<?php

namespace App\Domain\Manager;

use App\Domain\Service\Encryption\EncryptionFactory;

class EncryptManager
{
    private EncryptionFactory $factory;

    public function __construct(EncryptionFactory $factory)
    {
        $this->factory = $factory;
    }

    public function encryptValue(string $value): string
    {
        $encryption = $this->factory->create();

        return $encryption->encrypt($value);
    }
}
