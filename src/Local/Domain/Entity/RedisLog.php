<?php

namespace App\Local\Domain\Entity;

use App\AppBundle\Domain\Entity\Log;
use App\Local\Infrastructure\Repository\RedisLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'redisLog')]
#[ORM\Entity(repositoryClass: RedisLogRepository::class)]
class RedisLog extends Log
{
}
