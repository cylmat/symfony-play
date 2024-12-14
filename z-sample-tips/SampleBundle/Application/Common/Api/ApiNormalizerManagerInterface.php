<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common\Api;

interface ApiNormalizerManagerInterface
{
    public function normalizeResponse(ApiResponseInterface $response): array;
}
