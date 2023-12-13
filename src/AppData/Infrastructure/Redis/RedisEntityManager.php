<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Redis;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use App\AppData\Infrastructure\Redis\RedisClient;
use Doctrine\Persistence\ManagerRegistry;

final class RedisEntityManager implements AppEntityManagerInterface
{
    public function __construct(
        private readonly RedisClient $redisClient,
        private readonly ManagerRegistry $doctrineRegistry,
    ) {
    }

    public function persist(object $object): void
    {
        $this->redisClient->set($this->definedId($object), \serialize($object));
    }

    public function remove(object $object): void
    {
        $this->redisClient->del($this->definedId($object));
    }

    private function definedId(object $object): string
    {
        $tableName = $this->doctrineRegistry
            ->getManagerForClass($object::class)
            ->getClassMetadata($object::class)->getTableName();

        return $tableName.':'.$object->getId();
    }
}
