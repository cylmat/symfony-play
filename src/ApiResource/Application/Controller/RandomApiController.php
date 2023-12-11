<?php

declare(strict_types=1);

namespace App\ApiResource\Application\Controller;

use App\ApiResource\Application\RandomApiAction;
use App\AppBundle\Application\Common\AbstractApiController;
use App\AppBundle\Application\Common\AppRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @see https://fosrestbundle.readthedocs.io */
#[Route('/')]
final class RandomApiController extends AbstractApiController
{
    public function __invoke(RandomApiAction $action): Response
    {
        $data = $action->execute(new AppRequest());

        return $this->getApiResponse($data, Response::HTTP_OK);
    }
}
