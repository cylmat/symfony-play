<?php

namespace App\Local\Domain\EntityNoDoctrine;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Domain\Manager\ReplicateEntity;
use App\Local\Infrastructure\Repository\RedisLogRepository;

#[\stdClass(tablename: 'redisLog', repositoryClass: RedisLogRepository::class)]
#[ReplicateEntity(Log::class)]
class RedisLog extends Log
{
}
