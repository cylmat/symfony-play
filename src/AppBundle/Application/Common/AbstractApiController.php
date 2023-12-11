<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

use App\AppBundle\Application\OutputValidatorInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

class AbstractApiController extends AbstractFOSRestController
{
    public function __construct(
        protected readonly OutputValidatorInterface $output,
        // @todo use interface
        protected readonly ResponseNormalizer $normalizer,
    ) {   
    }

    protected function getApiResponse(ResponseInterface $data = null, ?int $statusCode = null, array $headers = []): Response
    {
        $this->responseNormalizer
        $view = $this->view($data, $statusCode, $headers);

        $response = $this->handleView($view);
        $this->output->validate($response->getContent());

        return $response;
    }
}
