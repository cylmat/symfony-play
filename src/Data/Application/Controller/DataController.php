<?php

declare(strict_types=1);

namespace App\Data\Application\Controller;

use App\AppBundle\Application\Common\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/data', name: 'app_data_index')]
final class DataController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('data/index.html.twig');
    }
}
