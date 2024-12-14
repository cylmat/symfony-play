<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common\Api;

use App\SampleBundle\Application\OutputValidatorInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

class AbstractApiController extends AbstractFOSRestController
{
    private const FORMAT_JSON = 'json';

    public function __construct(
        protected readonly OutputValidatorInterface $output,
        // @todo use interface
        protected readonly ApiNormalizerManagerInterface $responseNormalizer,
    ) {
    }

    protected function getApiResponse(ApiResponseInterface $response = null, ?int $statusCode = null, array $headers = []): Response
    {
        $data = $this->responseNormalizer->normalizeResponse($response);

        return $this->getApiRawResponse($data, $statusCode, $headers);
    }

    protected function getApiRawResponse(mixed $data = null, ?int $statusCode = null, array $headers = []): Response
    {
        $view = $this->view($data, $statusCode, $headers);
        $view->setFormat(self::FORMAT_JSON);
        $response = $this->handleView($view);

        $this->output->validate($response->getContent());

        return $response;
    }
}
