<?php

namespace App\Local\Infrastructure\Repository;

use App\AppBundle\Infrastructure\AppDoctrine;
use App\AppBundle\Infrastructure\Repository\LogRepository;

class RedisLogRepository extends LogRepository
{
    public function __construct(
        private AppDoctrine $registry
    ) {
    }
}
