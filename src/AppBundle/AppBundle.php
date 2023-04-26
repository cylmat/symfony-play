<?php

namespace App\AppBundle;

use App\AppBundle\DependencyInjection\Compiler\AppCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Symfony 6.2: Can extends AbstractBundle (with BundleExtension)
 * to avoid using Configuration and Extension class.
 *
 * @see https://symfony.com/doc/current/bundles.html
 *
 * @codeCoverageIgnore
 */
class AppBundle extends Bundle
{
    /* Called from Kernel::prepareContainer() */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new AppCompilerPass());
    }

    /* Called from Kernel::buildContainer() */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return parent::getContainerExtension();
    }
}
