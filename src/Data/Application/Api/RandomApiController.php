<?php

declare(strict_types=1);

namespace App\Data\Application\Api;

use App\AppBundle\Application\Common\Api\AbstractApiController;
use App\AppBundle\Application\Common\AppRequest;
use App\Data\Application\RandomApiAction;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/randomint', name: 'randomint')]
final class RandomApiController extends AbstractApiController
{
    public function __invoke(RandomApiAction $action): Response
    {
        $response = $action->execute(new AppRequest());

        return $this->getApiResponse($response);
    }
}
