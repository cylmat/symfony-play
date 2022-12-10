<?php

namespace App\Domain\Service\Encryption;

use App\Domain\Model\EncryptedData;

interface EncryptionInterface
{
    public function encrypt(string $value, array $options): EncryptedData;
}
