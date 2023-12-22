<?php

declare(strict_types=1);

namespace App\ApiResource\Controller;

use App\AppBundle\Application\Common\Api\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @see https://fosrestbundle.readthedocs.io */
#[Route('/')]
final class ApiController extends AbstractApiController
{
    public function __invoke(ApiAction $action): Response
    {
        $data = $action->execute();

        return $this->getApiRawResponse($data, Response::HTTP_OK);
    }
}
