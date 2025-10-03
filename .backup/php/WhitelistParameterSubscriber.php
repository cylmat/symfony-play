<?php

namespace App\Listener;

use App\Validator\WhitelistParameter;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionMethod;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ErrorController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class WhitelistParameterSubscriber implements EventSubscriberInterface
{
    private Request $request;
  
    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getMasterRequest();
    }
  
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => "onControllerEvent",
        ];
    }
  
    public function onControllerEvent(ControllerEvent $event): void
    {
        $controller = $event->getController();
        if (!is_array($controller) && $controller instanceof ErrorController) {
            return;
        }
        $method = new ReflectionMethod($controller[0], $controller[1]);
        $annotations = (new AnnotationReader())->getMethodAnnotations($method);
        foreach ($annotations as $ano) {
            if ($ano instanceof WhitelistParameter) {
                $ano->setRequest($this->request);
                $ano->validateWhitelist();
            }
        }
    }
}
