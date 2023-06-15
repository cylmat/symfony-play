<?php

namespace App\AppBundle\Infrastructure\Manager;

use App\AppBundle\Domain\Manager\AppEntityRegistry;
use App\Local\Infrastructure\RedisRepository;

class AppRepositoryRegistry
{
    public function __construct(
        private readonly AppEntityRegistry $appDoctrine,
        private readonly RedisRepository $redisRepository //@todo iterable AppRepositoryInterface
    ) {   
    }

    public function getRepositories(): iterable
    {
        yield $this->redisRepository;
    }
}
