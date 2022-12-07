<?php

namespace App\Domain\Service\Encryption;

interface EncryptionInterface
{
    public function encrypt(string $value, array $options): string;
}
