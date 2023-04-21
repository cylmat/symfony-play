<?php

namespace App\Text\Domain\Manager;

use App\Text\Domain\Service\CommandProcessInterface;

final class CommandManager
{
    public function __construct(
        /** @var CommandProcessInterface[] $commandProcesses */
        private readonly iterable $commandProcesses
    ) {
    }

    /** @param array[] $commandsParams */
    public function processText(string $text, array $commandsParams): string
    {
        foreach ($commandsParams as $commandParams) {
            $cmd = $this->chooseCommand($commandParams);
            $text = $cmd->processText($text, $commandParams);
        }

        return $text;
    }

    private function chooseCommand(array &$commandParams): CommandProcessInterface
    {
        foreach ($this->commandProcesses as $process) {
            if ($process::CMD === $commandParams['cmd']) {
                unset($commandParams['cmd']);

                return $process;
            }
        }

        throw new \LogicException('Command "'.$commandParams['cmd'].'" not found!');
    }
}
