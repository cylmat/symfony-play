<?php

namespace App\AppBundle;

//use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Symfony 6.2: Can extends AbstractBundle (with BundleExtension)
 * to avoid using Configuration and Extension class.
 *
 *  @see https://symfony.com/doc/current/bundles.html
 */
class AppBundle extends Bundle
{
    /* Called from Kernel::prepareContainer() */
    /*public function build(ContainerBuilder $container): void
    {
    }*/

    /* Called from Kernel::buildContainer() */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return parent::getContainerExtension();
    }
}
