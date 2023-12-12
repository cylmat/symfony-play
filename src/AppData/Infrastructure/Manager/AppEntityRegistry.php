<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class AppEntityRegistry
{
    /**
     * @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php
     */
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        #[TaggedIterator(AppEntityManagerInterface::TAG)]
        private readonly iterable $persistanceEntityRegistry,
    ) {
    }

    public function getDoctrineRegistry(): ManagerRegistry
    {
        return $this->doctrineRegistry;
    }

    public function persist(object $object): void
    {
        foreach ($this->doctrineRegistry->getManagers() as $entityManager) {
            $entityManager->persist($object);
            $entityManager->flush();
        }

        foreach ($this->persistanceEntityRegistry as $manager) {
            $manager->persist($object);
            $manager->flush();
        }
    }
}
