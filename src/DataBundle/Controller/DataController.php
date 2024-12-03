<?php

declare(strict_types=1);

namespace App\DataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/data', name: 'app_data_index')]
final class DataController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('data/index.html.twig', [
            'links' => $this->getLinks(),
        ]);
    }

    private function getLinks(): array
    {
        return [
            'randomApi' => $this->generateUrl('randomint')
        ];
    }
}
