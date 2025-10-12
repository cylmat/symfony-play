<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /** @SuppressWarnings(PHPMD) Unused code */
    private function configureContainer(ContainerConfigurator $container, LoaderInterface $loader, ContainerBuilder $builder): void
    {
        $configDir = $this->getConfigDir();

        $container->import($configDir.'/{packages}/*.{php,yaml}');
        $container->import($configDir.'/{packages}/'.$this->environment.'/*.{php,yaml}');

        if (is_file($configDir.'/services.yaml')) {
            $container->import($configDir.'/services.yaml');
            $container->import($configDir.'/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import($configDir.'/{services}.php');
        }
    }

    private function getData(ContainerConfigurator $container, string $configDir): void
    {
        // $container->import($configDir.'/local/parameters.{php,yaml}');
    }

    // private function getLocal(ContainerConfigurator $container, string $configDir): void
    // {
    //     $container->import($configDir.'/{packages}-data/*.{php,yaml}');
    //     $container->import($configDir.'/{packages}-data/'.$this->environment.'/*.{php,yaml}');
    // }
}
