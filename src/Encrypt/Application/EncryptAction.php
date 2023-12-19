<?php

declare(strict_types=1);

namespace App\Encrypt\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Application\Common\AppResponse;
use App\Encrypt\Domain\Manager\EncryptManager;

final class EncryptAction implements ActionInterface
{
    /* @todo Use array of values and factory */
    private const BCRYPT = 'bcrypt';

    public function __construct(
        private EncryptManager $encryptManager,
    ) {
    }

    public function execute(AppRequest $request): AppResponse
    {
        $data = $this->encryptManager->encryptValue(self::BCRYPT, $request->value, $request->options);

        return new AppResponse($data);
    }
}
