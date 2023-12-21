<?php

declare(strict_types=1);

namespace App\ApiResource\Application\Controller;

use App\AppBundle\Application\Common\Api\AbstractApiController as ApiAbstractApiController;
use App\AppBundle\Application\Common\AppRequest;
use App\Data\Application\RandomApiAction;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @see https://fosrestbundle.readthedocs.io */
#[Route('/')]
final class RandomApiController extends ApiAbstractApiController
{
    public function __invoke(RandomApiAction $action): Response
    {
        $data = $action->execute(new AppRequest());

        return $this->getApiResponse($data, Response::HTTP_OK);
    }
}
