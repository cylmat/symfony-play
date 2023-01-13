<?php

namespace App\AppBundle\Controller;

use App\Text\Application\TextAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TextController extends AbstractController
{
    #[Route('/text', name: 'app_text_index')]
    public function index(TextAction $action): Response
    {
        return $this->render('text/index.html.twig', []);
    }
}
