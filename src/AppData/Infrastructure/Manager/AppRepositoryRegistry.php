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

    /** @todo Use object entity instead of name. */
    public function remove(string $entityName): void
    {
        /** @todo Integration test this ! */
        foreach ($this->repositories as $repository) {
            $repository->setEntityName($entityName);
            foreach ($repository->findAll() as $entity) {
                $repository->remove($entity);
            }
        }
    }
}
