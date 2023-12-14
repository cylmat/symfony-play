<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
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

    public function getDoctrineManagerRegistry(): ManagerRegistry
    {
        return $this->doctrineRegistry;
    }

    public function persist(object $object): void
    {
        foreach ($this->doctrineRegistry->getManagers() as $doctrineEntityManager) {
            /** @var EntityManagerInterface $doctrineEntityManager */
            $doctrineEntityManager->persist($object);
            $doctrineEntityManager->flush();
        }

        foreach ($this->simulateEntityRegistry as $simulatedManager) {
            /** @var AppEntityManagerInterface $simulatedManager */
            $simulatedManager->persist($object);
        }
    }

    /** @todo implements remove() */

    public function getTableName(string $entityName): string
    {
        /** @var ObjectManager $manager */
        $manager = $this->doctrineRegistry
            ->getManagerForClass($entityName);

        return $manager->getClassMetadata($entityName)->getTableName();
    }
}
