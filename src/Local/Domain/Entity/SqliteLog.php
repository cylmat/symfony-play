<?php

namespace App\Local\Domain\Entity;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Domain\Manager\ReplicateEntity;
use App\Local\Infrastructure\Repository\SqliteLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'sqlitelog')]
#[ORM\Entity(repositoryClass: SqliteLogRepository::class)]
#[ReplicateEntity(Log::class)]
class SqliteLog extends Log
{
}
