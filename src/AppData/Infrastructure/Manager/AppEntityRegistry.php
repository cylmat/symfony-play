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
        private readonly iterable $noDoctrineEntityManagers,
        private readonly array $entityReplicasSupport,
        private readonly array $noDoctrineEntityManagersByNames,
    ) {
    }

    public function getDoctrine(): ManagerRegistry
    {
        return $this->doctrineManagerRegistry;
    }

    public function getTableName(string $entityName): string
    {
        /** @var ObjectManager $manager */
        $manager = $this->doctrineManagerRegistry
            ->getManagerForClass($entityName);

        return $manager->getClassMetadata($entityName)->getTableName();
    }

    public function save(object $entity): void
    {
        // doctrine first (create id)
        foreach ($this->getDoctrineManagerByNames($entity) as $doctrineEntityManager) {
            $doctrineEntityManager->persist($entity);
        }
        $doctrineEntityManager->flush();

        foreach ($this->getNoDoctrineManagerByNames($entity) as $noDoctrineManager) {
            $noDoctrineManager->save($entity);
        }
    }

    public function remove(object $entity): void
    {
        // no doctrine first
        foreach ($this->getNoDoctrineManagerByNames($entity) as $noDoctrineManager) {
            $noDoctrineManager->remove($entity);
        }

        foreach ($this->getDoctrineManagerByNames($entity) as $doctrineEntityManager) {
            $doctrineEntityManager->remove($entity);
        }
        $doctrineEntityManager->flush();
    }

    /** @return array<EntityManagerInterface> */
    private function getDoctrineManagerByNames(object $entity): array
    {
        $managers = [];
        foreach ($this->doctrineManagerRegistry->getManagers() as $managerName => $doctrineEntityManager) {
            /** @var EntityManagerInterface $doctrineEntityManager */
            if (!$this->isSupportedReplicasEntity($entity, $managerName)) {
                continue;
            }

            $managers[$managerName] = $doctrineEntityManager;
        }

        return $managers;
    }

    /** @return array<AppEntityManagerInterface> */
    private function getNoDoctrineManagerByNames(object $entity): array
    {
        $managers = [];
        foreach ($this->noDoctrineEntityManagersByNames as $managerName => $managerClassName) {
            if (!$this->isSupportedReplicasEntity($entity, $managerName)) {
                continue;
            }

            $managers[$managerName] =
                \array_filter(\iterator_to_array($this->noDoctrineEntityManagers),
                    fn (AppEntityManagerInterface $manager) => $manager::class === $managerClassName
                )[0];
        }

        return $managers;
    }

    private function isSupportedReplicasEntity(object $entity, string $managerName): bool
    {
        $supportedClasses = $this->entityReplicasSupport[$entity::class];

        if (self::DEFAULT === $managerName) {
            return true;
        }

        return \in_array($managerName, $supportedClasses);
    }
}
