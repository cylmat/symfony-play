<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

/**
 * Main component to manager object entity 
 * with doctrine and no-doctrine managers.
 */
final class AppEntityManager
{
    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    public function __construct(
        private readonly AppSupportRegistry $supportRegistry,
    ) {
    }

    public function save(object $entity): void
    {   
        $this->initSupport($entity);

        // Create id
        $this->supportRegistry->getDefaultDoctrineManager()->persist($entity);

        // other
        foreach ($this->supportRegistry->getReplicaDoctrineManagers() as $doctrineEntityManager) {
            $doctrineEntityManager->persist($entity);
        }
        $doctrineEntityManager->flush();

        // simili
        foreach ($this->supportRegistry->getSimiliReplicaDoctrineManagers() as $noDoctrineManager) {
            $noDoctrineManager->save($entity);
        }
    }

    public function remove(object $entity): void
    {
        $this->initSupport($entity);

        // no doctrine first
        foreach ($this->supportRegistry->getSimiliReplicaDoctrineManagers() as $noDoctrineManager) {
            $noDoctrineManager->remove($entity);
        }

        // doctrine
        $this->supportRegistry->getDefaultDoctrineManager()->remove($entity);
        foreach ($this->supportRegistry->getReplicaDoctrineManagers() as $doctrineEntityManager) {
            $doctrineEntityManager->remove($entity);
        }
        $doctrineEntityManager->flush();
    }

    private function initSupport(object $entity): void
    {
        $this->supportRegistry->setEntityName($entity::class);
    }
}
