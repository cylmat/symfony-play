<?php

declare(strict_types=1);

namespace App\MainBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'app_front')]
final class FrontController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('front/index.html.twig', [ ]);
    }
}
