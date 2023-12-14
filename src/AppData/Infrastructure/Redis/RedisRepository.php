<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Redis;

use App\AppData\Infrastructure\AppRepositoryInterface;
use App\AppData\Infrastructure\Manager\AppEntityRegistry;
use App\AppData\Infrastructure\Redis\RedisEntityManager;

final class RedisRepository implements AppRepositoryInterface
{
    private string $entityName;

    public function __construct(
        private readonly RedisEntityManager $redisPersistance,
        private readonly AppEntityRegistry $appRegistry,
    ) {
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function remove(object $entity): void
    {
        $this->redisPersistance->remove($entity);
    }

    public function findAll(): array
    {
        $tableName = $this->appRegistry->getTableName($this->entityName);

        $all = [];
        $keys = $this->redisPersistance->getClient()->keys($tableName.':*') ?? [];

        foreach ($keys as $key) {
            $serializedEntity = $this->redisPersistance->getClient()->get($key);
            $entity = \unserialize($serializedEntity);
            $all[$key] = $entity;
        }

        return $all;
    }
}
