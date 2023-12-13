<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class AppEntityRegistry
{
    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        #[TaggedIterator(AppEntityManagerInterface::TAG)]
        private readonly iterable $simulateEntityRegistry,
    ) {
    }

    public function persist(object $object): void
    {
        foreach ($this->doctrineRegistry->getManagers() as $doctrineEntityManager) {
            $doctrineEntityManager->persist($object);
            $doctrineEntityManager->flush();
        }

        foreach ($this->simulateEntityRegistry as $simulatedManager) {
            $simulatedManager->persist($object);
        }
    }

    public function getTableName(string $entityName): string
    {
        return $this->doctrineRegistry
            ->getManagerForClass($entityName)
            ->getClassMetadata($entityName)->getTableName();
    }

    // @todo implements remove()
}
