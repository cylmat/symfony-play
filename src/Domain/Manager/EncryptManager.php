<?php

namespace App\Domain\Manager;

use App\Domain\Service\Encryption\EncryptionFactory;

class EncryptManager
{
    public function __construct(
        private readonly EncryptionFactory $factory
    ) {}

    public function encryptValue(string $algo, string $value, array $options = []): string
    {
        return $this->factory->create($algo)->encrypt($value, $options)->getValue();
    }
}
