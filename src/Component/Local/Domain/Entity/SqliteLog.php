<?php

namespace App\Local\Domain\Entity;

use App\AppBundle\Domain\Entity\Log;
use App\Local\Infrastructure\Repository\SqliteLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'log')]
#[ORM\Entity(repositoryClass: SqliteLogRepository::class)]
class SqliteLog extends Log
{
}
