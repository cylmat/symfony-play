<?php

declare(strict_types=1);

namespace App\DataBundle\Controller;

use App\SampleBundle\Application\Common\Api\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/randomint', name: 'randomint')]
final class RandomApiController //extends AbstractApiController
{
    public function __invoke(): Response
    {
       // $response = $action->execute(new AppRequest());

        // return $this->getApiResponse();
        return new Response('ok');
    }
}
