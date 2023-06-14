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

        //$this->replicates($container);
        //$this->repositories($container);

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

    /*private function replicates($container): void
    {
        $serviceIds = $container->getServiceIds();

        $replicates = [];
        $allEntities = \array_filter($serviceIds, fn ($id) => false !== \strpos($id, '\\Domain\\Entity')); // doctrine + nodoctrine
        foreach ($allEntities as $id) {
            $entity = $container->get($id);
            $attributes = (new ReflectionClass($entity))->getAttributes();
            $replicateAttribute = \current(\array_filter($attributes, fn ($attribute) => false !== \strpos($attribute->getName(), '\\ReplicateEntity')));

            if ($replicateAttribute) {
                $root = $replicateAttribute->getArguments()[0];
                $replicates[$root][] = $id;
            }
        }

        $doc = $container->findDefinition(AppDoctrine::class);
        $doc->setArgument('$replicateEntities', $replicates);
    }

    private function repositories(ContainerBuilder $container): void
    {
        $serviceIds = $container->getServiceIds();

        $appRepos = [];
        foreach ($serviceIds as $id) {
            if (false !== \str_starts_with($id, 'App') && false !== \str_ends_with($id, 'Repository')) {
                $appRepos[$id] = new Reference($id);
            }
        }

        $doc = $container->findDefinition(AppDoctrine::class);
        $doc->setArgument('$appRepositories', $appRepos);
    }*/
}
