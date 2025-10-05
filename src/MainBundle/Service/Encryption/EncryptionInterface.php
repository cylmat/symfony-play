<?php

namespace App\MainBundle\Service\Encryption;

use App\MainBundle\Model\Play\EncryptedData;

interface EncryptionInterface
{
    /** @param int[] $options */
    public function encrypt(string $value, array $options): EncryptedData;
}
