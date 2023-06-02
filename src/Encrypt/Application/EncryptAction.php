<?php

namespace App\Encrypt\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\Encrypt\Domain\Manager\EncryptManager;

class EncryptAction implements ActionInterface
{
    /* @todo Use array of values and factory */
    private const BCRYPT = 'bcrypt';

    public function __construct(
        private EncryptManager $encryptManager
    ) {
    }

    public function execute(AppRequest $request): string
    {
        return $this->encryptManager->encryptValue(self::BCRYPT, $request->value, $request->options);
    }
}
