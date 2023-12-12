<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common\Api;

use App\AppBundle\Application\OutputValidatorInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

class AbstractApiController extends AbstractFOSRestController
{
    public function __construct(
        protected readonly OutputValidatorInterface $output,
        // @todo use interface
        protected readonly ApiNormalizerManagerInterface $responseNormalizer,
    ) {
    }

    protected function getApiResponse(ApiResponseInterface $response = null, ?int $statusCode = null, array $headers = []): Response
    {
        $data = $this->responseNormalizer->normalizeResponse($response);
        
        $view = $this->view($data, $statusCode, $headers);
        $response = $this->handleView($view);

        $this->output->validate($response->getContent());

        return $response;
    }
}
