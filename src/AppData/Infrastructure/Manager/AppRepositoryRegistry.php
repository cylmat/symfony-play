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
    private string $entityName;
    private array $doctrineManagers;

    private string $mainSupport;
    private array $doctrineReplicasSupport;
    private array $noDoctrineReplicasSupport;

    /** @param AppRepositoryInterface[] $appRepositories */
    public function __construct(
        private readonly AppEntityRegistry $appRegistry,
        #[TaggedIterator(AppRepositoryInterface::TAG)]
        private readonly iterable $appRepositories,
    ) {
        $this->doctrineManagers = $this->appRegistry->getDoctrineManagerRegistry()->getManagers();
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function setManagersSupport(string $main, array $doctrineReplicas = [], array $noDoctrineReplicas = []): void
    {
        $this->mainSupport = $main;
        $this->doctrineReplicasSupport = $doctrineReplicas;
        $this->noDoctrineReplicasSupport = $noDoctrineReplicas;
    }

    public function flushall(): void
    {
        /** @todo integration test this */
        foreach ($this->doctrineManagers as $entityManager) {
            $entities = $entityManager->createQueryBuilder()
                ->select('l')
                ->from($this->entityName, 'l')
                ->getQuery()
                ->execute();

            foreach ($entities as $e) {
                $entityManager->remove($e);
            }
            $entityManager->flush();
        }

        // Flush on App repositories
        $this->remove($this->entityName);
    }

    /** @todo Use object entity instead of name. */
    public function remove(string $entityName): void
    {
        /** @todo Integration test this ! */
        foreach ($this->appRepositories as $repository) {
            $repository->setEntityName($entityName);
            foreach ($repository->findAll() as $entity) {
                $repository->remove($entity);
            }
        }
    }
}
