<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

/**
 * Main component to manager object entity
 *  with doctrine and no-doctrine managers
 */
final class AppEntityRegistry
{
    private const DEFAULT = 'default';

    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    public function __construct(
        private readonly ManagerRegistry $doctrineManagerRegistry,
        #[TaggedIterator(AppEntityManagerInterface::TAG)]
        private readonly iterable $noDoctrineEntityManagerRegistry,
        private readonly array $entityReplicasSupport,
        private readonly array $noDoctrineEntityManagersByNames,
    ) {
    }

    public function getDoctrine(): ManagerRegistry
    {
        return $this->doctrineManagerRegistry;
    }

    public function persist(object $entity): void
    {
        foreach ($this->doctrineManagerRegistry->getManagers() as $managerName => $doctrineEntityManager) {
            /** @var EntityManagerInterface $doctrineEntityManager */
            if (!$this->isSupportedReplicasEntity($entity, $managerName)) {
                continue;
            }

            $doctrineEntityManager->persist($entity);
            $doctrineEntityManager->flush();
        }

        foreach ($this->getNoDoctrineManagerByNames() as $managerName => $noDoctrineManager) {
            /** @var AppEntityManagerInterface $noDoctrineManager */
            if (!$this->isSupportedReplicasEntity($entity, $managerName)) {
                continue;
            }

            $noDoctrineManager->persist($entity);
        }
    }

    /** @todo implements remove() */

    private function isSupportedReplicasEntity(object $entity, string $managerName): bool
    {
        $supportedClasses = $this->entityReplicasSupport[$entity::class];
        $this->handleNotExistingManagerName($supportedClasses);

        if (self::DEFAULT === $managerName) {
            return true;
        }

        return \in_array($managerName, $supportedClasses);
    }

    private function handleNotExistingManagerName(array $supportedClasses): void
    {
        $managerNames = \array_merge(
            \array_keys($this->doctrineManagerRegistry->getManagers())
            , \array_keys($this->getNoDoctrineManagerByNames())
        );

        foreach ($supportedClasses as $supportedClass) {
            if (!\in_array($supportedClass, $managerNames, true)) {
                throw new \DomainException("Manager '".$supportedClass."' not handled.");
            }
        }
    }

    private function getNoDoctrineManagerByNames(): array
    {
        $managers = [];
        foreach ($this->noDoctrineEntityManagersByNames as $name => $managerClassName) {
            $managers[$name] =
                \array_filter(\iterator_to_array($this->noDoctrineEntityManagerRegistry),
                    fn (AppEntityManagerInterface $manager) => $manager::class === $managerClassName
                )[0];
        }

        return $managers;
    }

    public function getTableName(string $entityName): string
    {
        /** @var ObjectManager $manager */
        $manager = $this->doctrineManagerRegistry
            ->getManagerForClass($entityName);

        return $manager->getClassMetadata($entityName)->getTableName();
    }
}
