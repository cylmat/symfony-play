<?php

namespace App\AppBundle\Application\DependencyInjection\Compiler;

use App\AppBundle\Domain\Manager\AppDoctrine;
use App\Text\Domain\Manager\CommandManager;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/** @see https://symfony.com/doc/current/service_container/tags.html */
/** @codeCoverageIgnore */
class AppCompilerPass implements CompilerPassInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @todo SET IT INTO TEXT BUNDLE
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(CommandManager::class)) {
            return;
        }

        $commandDefinition = $container->findDefinition(CommandManager::class);
        $tags = $container->findTaggedServiceIds('app.command_process');

        $replicates = [];
        foreach ($container->getServiceIds() as $id) {
            if (false !== \strpos($id, '\\Entity\\')) { // all Entities
                $entity = $container->get($id);
                $attributesEntity = (new ReflectionClass($entity))->getAttributes();

                foreach ($attributesEntity as $a) {
                    if (false !== \strpos($a->getName(), '\\ReplicateEntity')) {
                        $root = $a->getArguments()[0];
                        $replicates[$root][] = $id;
                    }
                }
            }
        }

        $doc = $container->findDefinition(AppDoctrine::class);
        $doc->setArgument('$replicateEntities', $replicates);

        /**
         * Replace the
         *   arguments:
         *     - !tagged_iterator { tag: app.sample, exclude: ['App\Handler\Class'] }.
         */
        $processes = [];
        \array_walk($tags, function ($value, $key) use (&$processes) {
            $processes[] = new Reference($key);
        });

        $iterator = new IteratorArgument($processes);
        $commandDefinition->setArgument('$commandProcesses', $iterator);
    }
}
