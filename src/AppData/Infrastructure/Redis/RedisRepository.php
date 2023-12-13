<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Redis;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use App\AppData\Infrastructure\AppRepositoryInterface;
use App\AppData\Infrastructure\Redis\RedisEntityManager;
use Doctrine\Persistence\ManagerRegistry;

final class RedisRepository implements AppRepositoryInterface
{
    private string $entityName;

    public function __construct(
        private readonly RedisEntityManager $redisPersistance,
        private readonly ManagerRegistry $doctrineRegistry,
        private readonly RedisClient $redisClient,
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
        $tableName = $this->doctrineRegistry
            ->getManagerForClass($this->entityName)
            ->getClassMetadata($this->entityName)->getTableName();

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
