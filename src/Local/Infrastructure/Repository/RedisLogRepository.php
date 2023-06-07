<?php

namespace App\Local\Infrastructure\Repository;

use App\Local\Domain\EntityNoDoctrine\RedisLog;
use App\Local\Infrastructure\Manager\RedisPersistanceManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class RedisLogRepository extends ServiceEntityRepository
{
    public function __construct(
        private RedisPersistanceManager $redisPersistance
    ) {
    }

    public function save(RedisLog $entity): void
    {
        $this->redisPersistance->persist($entity);
    }
}
