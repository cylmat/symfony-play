<?php

namespace App\Local\Infrastructure\Repository;

use App\AppBundle\Infrastructure\Repository\LogRepository;
use App\Local\Domain\Entity\SqliteLog;
use Doctrine\Persistence\ManagerRegistry;

class SqliteLogRepository extends LogRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SqliteLog::class);
    }
}
