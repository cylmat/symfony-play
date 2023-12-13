<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Redis;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use App\AppData\Infrastructure\AppRepositoryInterface;
use App\AppData\Infrastructure\Manager\AppEntityRegistry;
use App\AppData\Infrastructure\Redis\RedisEntityManager;

final class RedisRepository implements AppRepositoryInterface
{
    private string $entityName;

    public function __construct(
        private readonly RedisEntityManager $redisPersistance,
        private readonly RedisClient $redisClient,
        private readonly AppEntityRegistry $appRegistry,
    ) {
    }

    public function initialize(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function getEntityManager(): AppEntityManagerInterface
    {
        return $this->redisPersistance;
    }

    public function findAll(): array
    {
        $tableName = $this->appRegistry->getTableName($this->entityName);

        $all = [];
        $keys = $this->redisClient->keys($tableName.':*');

        foreach ($keys as $key) {
            $serializedEntity = $this->redisClient->get($key);
            $entity = \unserialize($serializedEntity);
            $all[$key] = $entity;
        }

        return $all;
    }
}
