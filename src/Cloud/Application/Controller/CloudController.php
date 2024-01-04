<?php

declare(strict_types=1);

namespace App\Cloud\Application\Controller;

use App\AppBundle\Application\Common\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cloud', name: 'app_cloud_index')]
final class CloudController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('cloud/index.html.twig', [
            'links' => $this->getLinks(),
        ]);
    }

    private function getLinks(): array
    {
        return [
            
        ];
    }
}
