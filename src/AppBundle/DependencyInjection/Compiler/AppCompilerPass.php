<?php

namespace App\AppBundle\DependencyInjection\Compiler;

use App\Text\Domain\Manager\CommandManager;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/** @see https://symfony.com/doc/current/service_container/tags.html */
class AppCompilerPass implements CompilerPassInterface
{
    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(CommandManager::class)) {
            return;
        }

        $commandManagerDefinition = $container->findDefinition(CommandManager::class);
        $tags = $container->findTaggedServiceIds('app.command_process');

        /**
         * Replace the 
         *   arguments:
         *     - !tagged_iterator { tag: app.sample, exclude: ['App\Handler\Class'] }
         */
        $processes = [];
        \array_walk($tags, function($value, $key) use (&$processes) { $processes[] = new Reference($key); });

        $iterator = new IteratorArgument($processes);
        $commandManagerDefinition->setArgument('$commandProcesses', $iterator);
    }
}
