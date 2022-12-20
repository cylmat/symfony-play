<?php

namespace App\AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppCompilerPass implements CompilerPassInterface
{
    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function process(ContainerBuilder $container): void
    {
    }
}
