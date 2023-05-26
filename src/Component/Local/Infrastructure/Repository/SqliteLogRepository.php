<?php

namespace App\Local\Infrastructure\Repository;

use App\Local\Domain\Entity\SqliteLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SqliteLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SqliteLog::class);
    }

    public function removeAll(): void
    {
    }
}
