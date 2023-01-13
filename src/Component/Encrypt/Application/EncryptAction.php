<?php

namespace App\Encrypt\Application;

use App\AppBundle\Common\ActionInterface;
use App\AppBundle\Common\AppRequest;
use App\Encrypt\Domain\Manager\EncryptManager;

class EncryptAction implements ActionInterface
{
    private const NEEDTOBECHANGED = 'bcrypt';

    public function __construct(
        private EncryptManager $encryptManager
    ) {
    }

    public function execute(AppRequest $request): string
    {
        return $this->encryptManager->encryptValue(self::NEEDTOBECHANGED, $request->value, $request->options);
    }
}
