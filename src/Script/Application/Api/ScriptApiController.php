<?php

declare(strict_types=1);

namespace App\Script\Application\Api;

use App\AppBundle\Application\Common\Api\AbstractApiController;
use App\AppBundle\Application\Common\AppRequest;
use App\Script\Application\Python\ScriptAction;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/script', name: 'script_api')]
final class ScriptApiController extends AbstractApiController
{
    public function __invoke(ScriptAction $action): Response
    {
        $response = $action->execute(new AppRequest());

        return $this->getApiResponse($response);
    }
}
