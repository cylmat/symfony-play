<?php

namespace App\Text\Domain\Manager;

use App\AppBundle\Service\LoggerAwareInterface;
use App\AppBundle\Service\LoggerTrait;
use App\Text\Domain\Service\CommandProcessInterface;
use LogicException;

final class CommandManager implements LoggerAwareInterface
{
    use LoggerTrait;

    private const LOGGER_CHANNEL = 'command';

    public function __construct(
        /** @var CommandProcessInterface[] $commandProcesses */
        private readonly iterable $commandProcesses
    ) {
    }

    /** @param mixed[][] $commandsParams */
    public function processText(string $text, array $commandsParams): string
    {
        foreach ($commandsParams as $commandParams) {
            $cmd = $this->chooseCommand($commandParams);
            $text = $cmd->processText($text, $commandParams);
        }

        return $text;
    }

    /** @param string[] $commandParams */
    private function chooseCommand(array &$commandParams): CommandProcessInterface
    {
        foreach ($this->commandProcesses as $process) {
            if ($process::CMD === $commandParams['cmd']) {
                $this->getLogger(self::LOGGER_CHANNEL)->info('Command "'.$process::CMD.'" being processed.');
                unset($commandParams['cmd']);

                return $process;
            }
        }

        throw new LogicException('Command "'.$commandParams['cmd'].'" not found!');
    }
}
