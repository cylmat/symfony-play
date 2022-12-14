<?php

namespace App;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Twig\Environment;

class ControllerTestCase extends TestCase
{
    protected ContainerInterface $container;
    protected Environment $twig;
    protected FlashBagAwareSessionInterface $sessionFlashBag;
    protected FlashBagInterface $flashBag;
    protected FormFactoryInterface $formFactory;
    protected FormInterface $form;
    protected RequestStack $requestStack;

    protected function setUp(): void
    {
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

    private function initServices(): void
    {
        $this->form = $this->createMock(FormInterface::class);
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->sessionFlashBag = $this->createMock(FlashBagAwareSessionInterface::class);
        $this->flashBag = $this->createMock(FlashBagInterface::class);
        $this->twig = $this->createMock(Environment::class);
    }

    public function containerCallback(string $serviceName): ?object
    {
        /* @phpstan-ignore-next-line */
        $this->sessionFlashBag
            ->method('getFlashBag')
            ->willReturn($this->flashBag)
        ;

        /* @phpstan-ignore-next-line */
        $this->requestStack
            ->method('getSession')
            ->willReturn($this->sessionFlashBag)
        ;

        return match ($serviceName) {
            'form.factory' => $this->formFactory,
            'request_stack' => $this->requestStack,
            'twig' => $this->twig,
            default => null,
        };
    }
}
