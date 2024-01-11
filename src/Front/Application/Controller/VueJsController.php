<?php

declare(strict_types=1);

namespace App\Front\Application\Controller;

use App\AppBundle\Application\Common\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vuejs2', name: 'app_vuejs')]
final class VueJsController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('front/vuejs/index.html.twig', [ ]);
    }
}
