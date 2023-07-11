<?php

namespace App\Local\Infrastructure;

use App\AppBundle\Infrastructure\AppEntityManagerInterface;
use App\AppBundle\Infrastructure\AppRepositoryInterface;
use App\Local\Infrastructure\Manager\RedisEntityManager;
use Doctrine\Persistence\ManagerRegistry;

class RedisRepository implements AppRepositoryInterface
{
    private string $entityName;

    public function __construct(
        private readonly RedisEntityManager $redisPersistance,
        private readonly ManagerRegistry $doctrineRegistry
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
        $keys = $this->redisPersistance->getClient()->keys($tableName.':*');

        foreach ($keys as $key) {
            $serializedEntity = $this->redisPersistance->getClient()->get($key);
            $entity = \unserialize($serializedEntity);
            $all[$key] = $entity;
        }

        return $all;
    }
}
