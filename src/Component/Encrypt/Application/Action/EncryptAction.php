<?php

namespace App\Encrypt\Application\Action;

use App\Encrypt\Domain\Manager\EncryptManager;

class EncryptAction
{
    private const NEEDTOBECHANGED = 'bcrypt';

    public function __construct(
        private EncryptManager $encryptManager
    ) {
    }

    /** @param mixed[] $options */
    public function execute(string $value, array $options): string
    {
        return $this->encryptManager->encryptValue(self::NEEDTOBECHANGED, $value, $options);
    }
}
