<?php

namespace App\AppBundle\Infrastructure\Bridge\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/** @see https://symfony.com/doc/current/bundles/configuration.html */
/** @codeCoverageIgnore */
final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = (new TreeBuilder('app'));

        $treeBuilder->getRootNode()
            ->children()
                ->booleanNode('enabled')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
