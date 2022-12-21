<?php

namespace App\Encrypt\Domain\Service\Encryption;

use App\Encrypt\Domain\Exception\AlgorithmNotFoundException;

class EncryptionFactory
{
    public function create(string $algorithm): EncryptionInterface
    {
        return match (strtoupper($algorithm)) {
            HashAlgorithm::BCRYPT => new BcryptEncryption(),
            default => throw new AlgorithmNotFoundException()
        };
    }
}
