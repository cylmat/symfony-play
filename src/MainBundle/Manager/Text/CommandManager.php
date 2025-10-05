<?php

namespace App\MainBundle\Manager\Text;

use App\MainBundle\Contract\LoggerAwareInterface;
use App\MainBundle\Contract\LoggerTrait;
use App\MainBundle\Service\Text\CommandProcessInterface;
use LogicException;

final class CommandManager //implements LoggerAwareInterface
{
    // use LoggerTrait;

    private const COMMAND_LOGGER_CHANNEL = 'command';

    public function __construct(
        // /** @var CommandProcessInterface[] $commandProcesses */
        // private readonly iterable $commandProcesses,
        // private readonly MessageBusInterface $logMessageBus, // messenger.bus.default
    ) {
    }

    /** @param mixed[][] $commandsParams */
    public function processText(string $text, array $commandsParams): string
    {
        foreach ($commandsParams as $commandParams) {
           // $cmd = $this->chooseCommand($text, $commandParams);
            //$text = $cmd->processText($text, $commandParams);
        }

        return $text;
    }

    /** @param string[] $commandParams */
    private function chooseCommand(string $text, array &$commandParams): CommandProcessInterface
    {
        foreach ($this->commandProcesses as $process) {
            if ($process::CMD === $commandParams['cmd']) {
                $this->logMessageBus->dispatch(
                    new LogMessage([
                        /** @todo don't call message entity directly but use app service */
                        'channel' => self::COMMAND_LOGGER_CHANNEL,
                        'logmessage' => 'Command "'.$process::CMD.'" with "'.substr($text, 0, 3).'..." processed.',
                    ])
                );
                unset($commandParams['cmd']);

                return $process;
            }
        }

        throw new LogicException('Command "'.$commandParams['cmd'].'" not found!');
    }
}
