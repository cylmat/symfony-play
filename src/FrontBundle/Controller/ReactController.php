<?php

declare(strict_types=1);

namespace App\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/react', name: 'app_react')]
final class ReactController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('react/index.html.twig');
    }
}
