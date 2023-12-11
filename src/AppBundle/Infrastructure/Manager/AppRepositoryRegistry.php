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

    public function remove(string $entityName): void
    {
        $this->initRepositories($entityName);

        /** @todo Integration test this ! */
        foreach ($this->repositories as $repository) {
            foreach ($repository->findAll() as $entity) {
                $repository->getEntityManager()->remove($entity);
            }
        }
    }
    
    private function initRepositories(string $entityName): void
    {
        foreach ($this->repositories as $repository) {
            $repository->initialize($entityName);
        }
    }
}
