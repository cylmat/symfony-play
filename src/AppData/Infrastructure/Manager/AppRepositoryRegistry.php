<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use App\AppData\Infrastructure\AppRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

/**
 * Get every EntityManager repositories for no-doctrine
 */
final class AppRepositoryRegistry
{
    private string $entityName;

    /** @param AppRepositoryInterface[] $appRepositories */
    public function __construct(
        private readonly ManagerRegistry $doctrineManagerRegistry,
        #[TaggedIterator(AppRepositoryInterface::TAG)]
        private readonly iterable $appRepositories,
    ) {
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    /** @param AppRepositoryInterface[] $appRepositories */
    public function getSimiliDoctrineRepositories(): array // todo Generator 
    {
        // @todo init entity name
        return $this->appRepositories;
    }
}
