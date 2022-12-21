<?php

namespace App\Component\Encrypt\Domain\Service\Encryption;

use App\Component\Encrypt\Domain\Model\EncryptedData;

interface EncryptionInterface
{
    /** @param int[] $options */
    public function encrypt(string $value, array $options): EncryptedData;
}
