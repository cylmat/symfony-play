<?php

namespace App\AwsBundle\Manager;

use App\AwsBundle\Service\ElastiCacheService;

final class ElastiCacheManager
{
    public function __construct(
        private readonly ElastiCacheService $elastiCacheService
    ) {}

    public function run()
    {
        $this->elastiCacheService->run();
    }
}
