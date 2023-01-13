<?php

namespace App\AppBundle\Controller;

use App\AppBundle\Common\AppRequest;
use App\Text\Application\TextAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TextController extends AbstractController
{
    #[Route('/text', name: 'app_text_index')]
    public function index(TextAction $textAction): Response
    {
        /* @todo */
        $textAction->execute(new AppRequest(['text' => 'val', 'arguments' => ['val' => 'val2']]));

        return $this->render('text/index.html.twig', []);
    }
}
