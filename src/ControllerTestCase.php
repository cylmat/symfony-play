<?php

namespace App;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;

class ControllerTestCase extends TestCase
{
    protected ContainerInterface $container;
    protected FormFactoryInterface $formFactory;
    protected Environment $twig;

    protected function setUp(): void
    {
        $t = $this;
        $this->initServices();

        $this->container = $this->createMock(ContainerInterface::class);
        $this->container
            ->method('has')
            ->willReturn(true)
        ;
        $this->container
            ->method('get')
            ->will($this->returnCallback([$this, 'containerCallback']))
        ;
    }

    protected function initServices(): void
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->twig = $this->createMock(Environment::class);
    }

    public function containerCallback(string $serviceName): object
    {
        return match ($serviceName) {
            'form.factory' => $this->formFactory,
            'twig' => $this->twig,
        };
    }
}
