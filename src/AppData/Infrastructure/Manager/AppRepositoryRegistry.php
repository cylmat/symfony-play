<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use App\AppData\Infrastructure\AppRepositoryInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

/**
 * Get every EntityManager repositories from doctrine
 */
final class AppRepositoryRegistry
{
    /** @param AppRepositoryInterface[] $repositories */
    public function __construct(
        #[TaggedIterator(AppRepositoryInterface::TAG)]
        private readonly iterable $repositories,
    ) {
    }

    public function remove(string $entityName): void
    {
        $this->initRepositories($entityName);

        /** @todo Integration test this ! */
        foreach ($this->repositories as $repository) {
            foreach ($repository->findAll() as $entity) {
                $repository->remove($entity);
            }
        }
    }
    
    private function initRepositories(string $entityName): void
    {
        foreach ($this->repositories as $repository) {
            $repository->setEntityName($entityName);
        }
    }
}
