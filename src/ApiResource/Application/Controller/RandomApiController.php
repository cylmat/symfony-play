<?php

namespace App\ApiResource\Application\Controller;

use App\ApiResource\Application\RandomApiAction;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Infrastructure\Contracts\JsonApiValidatorInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @see https://fosrestbundle.readthedocs.io */
class RandomApiController extends AbstractFOSRestController
{
    #[Route('/')]
    public function getRandomIntAction(RandomApiAction $action, JsonApiValidatorInterface $jsonValidator): Response
    {
        $data = $action->execute(new AppRequest());
        $view = $this->view($data, Response::HTTP_OK);

        $response = $this->handleView($view);
        $jsonValidator->validate($response->getContent());

        return $response;
    }
}
