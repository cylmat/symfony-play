<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Redis;

use App\AppData\Infrastructure\AppRepositoryInterface;
use App\AppData\Infrastructure\Manager\AppManagerRegistry;

final class RedisRepository implements AppRepositoryInterface
{
    private string $entityName;

    public function __construct(
        private readonly RedisClient $redisClient,
        private readonly AppManagerRegistry $appRegistry,
    ) {
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function flushAll(): void
    {
        // to implements ...
    }

    public function truncate(): void
    {
        // ...
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
