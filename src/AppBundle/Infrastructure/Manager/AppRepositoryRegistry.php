<?php

declare(strict_types=1);

namespace App\AppBundle\Infrastructure\Manager;

use App\AppBundle\Infrastructure\AppRepositoryInterface;

/**
 * Get every EntityManager repositories from doctrine
 */
final class AppRepositoryRegistry
{
    /** @param AppRepositoryInterface[] $repositories */
    public function __construct(
        private readonly iterable $repositories,
    ) {
    }

    /** @return AppRepositoryInterface[] */
    public function getRepositories(): iterable
    {
        return $this->repositories;
    }
}
