<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common\Api;

interface ApiResponseNormalizerManagerInterface
{
    public function normalizeResponse(ApiResponseInterface $response): array;
}
