<?php

use App\AppBundle\Domain\Entity\Log;
use App\Local\Domain\Entity\RedisLog;
use App\Local\Domain\Entity\SqliteLog;

$container->setParameter(
    'replicateEntities',
    [
        Log::class => [
            SqliteLog::class,
            RedisLog::class,
        ]
    ]
);
