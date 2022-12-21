<?php

namespace App\Encrypt\Domain\Service\Encryption;

use App\Encrypt\Domain\Model\EncryptedData;

interface EncryptionInterface
{
    /** @param int[] $options */
    public function encrypt(string $value, array $options): EncryptedData;
}
