<?php

namespace App\AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * Symfony 6.2: Can extends AbstractBundle to avoid using Extension class
 * Called from MergeExtensionConfigurationPass::process().
 *
 * @codeCoverageIgnore
 */
class AppExtension extends Extension implements ExtensionInterface, PrependExtensionInterface
{
    // Contains all service
    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function prepend(ContainerBuilder $container): void
    {
    }

    /** @SuppressWarnings(PHPMD.IfStatementAssignment) */
    public function load(array $config, ContainerBuilder $container): void
    {
        if ($configuration = $this->getConfiguration($config, $container)) {
            $config = $this->processConfiguration($configuration, $config);
        }
    }

    /** @param mixed[] $config */
    public function getConfiguration(array $config, ContainerBuilder $container): ?ConfigurationInterface
    {
        return parent::getConfiguration($config, $container);
    }
}
