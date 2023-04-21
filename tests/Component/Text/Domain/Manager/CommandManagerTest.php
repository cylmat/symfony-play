<?php

namespace App\Tests\Text\Domain\Manager;

use App\Text\Domain\Manager\CommandManager;
use App\Text\Domain\Service\CommandProcessInterface;
use PHPUnit\Framework\TestCase;

final class TestCommandProcess implements CommandProcessInterface
{
    public const CMD = 'test-cmd';
    public function processText(string $text, array $commandsParams): string
    {
        return 'testing1';
    }
}

final class CommandManagerTest extends TestCase
{
    private CommandManager $cmdManager;
    private TestCommandProcess $commandProcess;

    public function setUp(): void
    {
        // @see RewindableGenerator
        $this->commandProcess = new TestCommandProcess();
        $iterable = new \ArrayIterator([$this->commandProcess]);
        $this->cmdManager = new CommandManager($iterable);
    }

    public function testProcesses(): void
    {
        $text = $this->cmdManager->processText('gamma-delta', [
            [
                'cmd' => 'test-cmd',
                'arguments' => ['whatever'],
            ]
        ]);

        $this->assertSame('testing1', $text);
    }

    public function testProcessesException(): void
    {
        $this->expectExceptionMessage('Command "invalid-command" not found!');
        $text = $this->cmdManager->processText(
            'gamma-delta',
            [
                [
                    'cmd' => 'invalid-command',
                    'arguments' => ['pattern' => 'gamma', 'replace' => 'alpha'],
                ],
            ],
        );

        $this->assertSame('alpha-beta', $text);
    }
}
