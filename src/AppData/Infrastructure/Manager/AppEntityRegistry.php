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
        private readonly iterable $simulateEntityRegistry,
    ) {
    }

    public function persist(object $object): void
    {
        foreach ($this->doctrineRegistry->getManagers() as $entityManager) {
            $entityManager->persist($object);
            $entityManager->flush();
        }

        foreach ($this->simulateEntityRegistry as $manager) {
            $manager->persist($object);
        }
    }
}
