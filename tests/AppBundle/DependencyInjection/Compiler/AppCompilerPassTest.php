<?php

namespace App\Test\AppBundle\DependencyInjection\Compiler;

use App\AppBundle\DependencyInjection\Compiler\AppCompilerPass;
use App\Text\Domain\Manager\CommandManager;
use App\Text\Domain\Service\SedProcess;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class AppCompilerPassTest extends TestCase
{
    private ContainerBuilder|MockObject $container;
    private AppCompilerPass $appCompilerPass;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerBuilder::class);
        $this->appCompilerPass = new AppCompilerPass();
    }

    public function testProcess(): void
    {
        $this->container
            ->method('has')
            ->with(CommandManager::class)
            ->willReturn(true)
        ;
        $this->container
            ->method('findDefinition')
            ->with(CommandManager::class)
            ->willReturn($definition = new Definition(CommandManager::class))
        ;
        $this->container
            ->method('findTaggedServiceIds')
            ->with('app.command_process')
            ->willReturn([SedProcess::class => [[]]])
        ;

        $this->appCompilerPass->process($this->container);

        /** @var IteratorArgument $arg */
        $arg = $definition->getArgument('$commandProcesses');

        $this->assertSame(SedProcess::class, (string)$arg->getValues()[0]);
    }
}
