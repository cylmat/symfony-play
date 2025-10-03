<?php

declare(strict_types=1);

namespace App\MainBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vuejs2', name: 'app_vuejs')]
final class VueJsController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('vuejs/index.html.twig');
    }
}
