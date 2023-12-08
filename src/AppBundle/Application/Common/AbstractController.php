<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;
use Symfony\Component\HttpFoundation\Response;

class AbstractController extends SymfonyAbstractController
{
    public function render(string $view, array $parameters = [], ?Response $response = null): Response
    {
        return parent::render($view, $parameters, $response);
    }
}
