<?php

namespace App\AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/** @see https://symfony.com/doc/current/bundles/configuration.html */
final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = (new TreeBuilder('app'));

        /* @phpstan-ignore-next-line */
        $treeBuilder->getRootNode()
            ->children()
                ->booleanNode('enabled')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
