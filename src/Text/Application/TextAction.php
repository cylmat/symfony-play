<?php

namespace App\Text\Application;

use App\AppBundle\Application\Common\AbstractAction;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Domain\Message\LogMessage;
use App\Text\Domain\Manager\CommandManager;
use Symfony\Component\Messenger\MessageBusInterface;

final class TextAction extends AbstractAction
{
    public function __construct(
        private readonly CommandManager $cmdManager,
        private readonly MessageBusInterface $logMessageBus // messenger.bus.default
    ) {
    }

    public function execute(AppRequest $request): string
    {
        $this->logMessageBus->dispatch(
            new LogMessage([
                'text' => $request->text,
                'commands' => $request->commands,
            ])
        );

        return $this->cmdManager->processText($request->text, $request->commands);
    }
}
