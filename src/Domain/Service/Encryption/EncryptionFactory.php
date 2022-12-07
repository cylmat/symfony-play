<?php

namespace App\Domain\Service\Encryption;

use App\Domain\Exception\AlgorithmNotFoundException;

class EncryptionFactory
{
    public function create(string $algorithm): EncryptionInterface
    {
        return match (strtoupper($algorithm)) {
            HashAlgorithm::BCRYPT => new BcryptEncryption(),
        };

        throw new AlgorithmNotFoundException();
    }
}
