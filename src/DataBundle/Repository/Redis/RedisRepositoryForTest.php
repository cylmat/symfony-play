<?php

declare(strict_types=1);

namespace App\DataBundle\Repository\Redis;

use App\AppData\Infrastructure\Manager\AppEntityManager;

final class RedisRepositoryForTest
{
    private string $entityName;

    public function __construct(
        private readonly RedisClient $redisClient,
        private readonly AppEntityManager $appRegistry,
    ) {
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function findAll(): array
    {
        $tableName = $this->appRegistry->getTableName($this->entityName);

        $all = [];
        $keys = $this->redisClient->keys($tableName.':*') ?? [];

        foreach ($keys as $key) {
            $serializedEntity = $this->redisClient->get($key);
            $entity = \unserialize($serializedEntity);
            $all[$key] = $entity;
        }

        return $all;
    }
}
