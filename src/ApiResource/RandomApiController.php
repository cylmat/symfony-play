<?php

namespace App\ApiResource;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @see https://fosrestbundle.readthedocs.io */
class RandomApiController extends AbstractFOSRestController
{
    #[Route("/random")]
    public function getRandomIntAction(): Response
    {
        $data = [
            'type' => 'api',
            'format' => 'json',
            'data' => [
                'random_int' => random_int(1, 9),
            ],
        ];
        $view = $this->view($data, Response::HTTP_OK);

        return $this->handleView($view);
    }
}
