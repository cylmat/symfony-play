<?php

namespace App\Text\Application;

use App\AppBundle\Application\Common\AbstractAction;
use App\AppBundle\Application\Common\AppRequest;
use App\Text\Domain\Manager\CommandManager;

final class TextAction extends AbstractAction
{
    public function __construct(
        private readonly CommandManager $cmdManager
    ) {
    }

    public function execute(AppRequest $request): string
    {
        return $this->cmdManager->processText($request->text, $request->commands);
    }
}
