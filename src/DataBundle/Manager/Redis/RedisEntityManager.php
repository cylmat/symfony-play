<?php

declare(strict_types=1);

namespace App\DataBundle\Manager\Redis;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use App\AppData\Infrastructure\Manager\AppEntityManager;
use App\AppData\Infrastructure\Redis\RedisClient;

final class RedisEntityManager implements AppEntityManagerInterface
{
    public function __construct(
        private readonly RedisClient $redisClient,
        private readonly RedisRepository $redisRepository,
        private readonly AppEntityManager $appRegistry,
    ) {
    }

    public function getRepository(): RedisRepository
    {
        return $this->redisRepository;
    }

    public function save(object $object): void
    {
        $this->redisClient->set($this->getId($object), \serialize($object));
    }

    public function remove(object $object): void
    {
        $this->redisClient->del($this->getId($object));
    }

    private function getId(object $object): string
    {
        $tableName = $this->appRegistry->getTableName($object::class);

        return $tableName.':'.$object->getId();
    }
}
