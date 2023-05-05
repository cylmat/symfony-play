<?php

namespace App\Text\Application;

use App\AppBundle\Common\AbstractAction;
use App\AppBundle\Common\AppRequest;
use App\Local\Domain\RedisManager;
use App\Text\Domain\Manager\CommandManager;

final class TextAction extends AbstractAction
{
    public function __construct(
        private CommandManager $cmdManager,
        private RedisManager $redis
    ) {
        /**
         * @todo REMOVE TEST !!!
         */
        $redis->test();
    }

    public function execute(AppRequest $request): string
    {
        return $this->cmdManager->processText($request->text, $request->commands);
    }
}
