<?php

declare(strict_types=1);

namespace App\Script\Application\Python;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\Script\Application\Python\ScriptResponse;
use App\Script\Domain\Script\ScriptManager;

final class ScriptAction implements ActionInterface
{
    public function __construct(
        private readonly ScriptManager $scriptManager,
    ) {
    }

    public function execute(AppRequest $request): ScriptResponse
    {
        return new ScriptResponse($this->scriptManager->getData());
    }
}
