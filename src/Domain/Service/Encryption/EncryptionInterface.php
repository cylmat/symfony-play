<?php

namespace App\Domain\Service\Encryption;

use App\Domain\Model\EncryptedData;

interface EncryptionInterface
{
    /** @param int[] $options */
    public function encrypt(string $value, array $options): EncryptedData;
}
