<?php

namespace App\Component\Encrypt\Domain\Service\Encryption;

use App\Component\Encrypt\Domain\Exception\AlgorithmNotFoundException;

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
