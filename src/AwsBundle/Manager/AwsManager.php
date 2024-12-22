<?php

namespace App\AwsBundle\Manager;

use App\AwsBundle\Service\DynamoService;
use App\AwsBundle\Service\ElastiCacheService;
use Aws\DynamoDb\DynamoDbClient;

final class AwsManager
{
    public function __construct(
        // private readonly ElastiCacheService $elastiCacheService,
        private readonly DynamoService $dynamoService
    ) {}

    public function run(): array
    {
        $results = [];
        $dynamodb = $this->dynamoService->run(DynamoService::LIST_TABLES);

        $results['dynamodb'] = $dynamodb;

        return $results;
    }
}
