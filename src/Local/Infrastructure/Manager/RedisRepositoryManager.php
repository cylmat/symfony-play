<?php

namespace App\Local\Infrastructure\Manager;

use Doctrine\Persistence\ManagerRegistry;

class RedisRepositoryManager
{
    private string $entityName;

    public function __construct(
        private readonly RedisPersistanceManager $redisPersistance,
        private readonly ManagerRegistry $doctrineRegistry
    ) {
    }

    public function initialize(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function getPersistanceManager(): RedisPersistanceManager
    {
        return $this->redisPersistance;
    }

    public function findAll(): array
    {
        $tableName = $this->doctrineRegistry
            ->getManagerForClass($this->entityName)
            ->getClassMetadata($this->entityName)->getTableName();

        $all = [];
        $keys = $this->redisPersistance->getClient()->keys($tableName . ':*');

        foreach ($keys as $key) {
            $serializedEntity = $this->redisPersistance->getClient()->get($key);
            $entity = \unserialize($serializedEntity);
            $all[$key] = $entity;
        }

        return $all;
    }
}
