<?php

namespace App\Encrypt\Domain\Manager;

use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;

class EncryptManager
{
    public function __construct(
        private readonly EncryptionFactory $factory
    ) {
    }

    /** @param int[] $options */
    public function encryptValue(string $algo, string $value, array $options = []): string
    {
        return $this->factory->create($algo)->encrypt($value, $options)->getValue();
    }
}
