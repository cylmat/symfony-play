<?php

namespace App\AppBundle\Infrastructure\Manager;

use App\AppBundle\Domain\Manager\AppEntityRegistry;
use App\AppBundle\Infrastructure\AppRepositoryInterface;

class AppRepositoryRegistry
{
    /** @param AppRepositoryInterface[] $repositories */
    public function __construct(
        private readonly AppEntityRegistry $appDoctrine,
        private readonly iterable $repositories
    ) {
    }

    /** @return AppRepositoryInterface[] */
    public function getRepositories(): iterable
    {
        return $this->repositories;
    }
}
