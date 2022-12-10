<?php

namespace App\Domain\Model;

class EncryptedData
{
    public function __construct(
        private readonly string $value
    ) {}

    public function getValue(): string
    {
        return $this->value;
    }
}
