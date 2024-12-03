<?php

declare(strict_types=1);

namespace App\DataBundle\Manager;

use App\AppData\Infrastructure\AppEntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

/**
 * Manage supported managers from configured entity list
 */
final class AppSupportRegistry
{
    private const DEFAULT = 'default';

    private string $entityName;

    public function __construct(
        private readonly ManagerRegistry $doctrineManagerRegistry,
        // #[TaggedIterator(AppEntityManagerInterface::TAG)]
        private readonly iterable $noDoctrineEntityManagers,
        private readonly array $entityReplicasSupport,
        private readonly array $noDoctrineEntityManagerList,
    ) {
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function getManager(string $name): EntityManagerInterface //|AppEntityManagerInterface
    {
        return $this->getAllManagers()[$name];
    }

    public function getDefaultDoctrineManager(): EntityManagerInterface
    {
        return $this->doctrineManagerRegistry->getManager(self::DEFAULT);
    }

    /** @return array<EntityManagerInterface> */
    public function getDoctrineReplicaManagers(): array
    {
        $managers = [];
        foreach ($this->doctrineManagerRegistry->getManagers() as $managerName => $doctrineEntityManager) {
            /** @var EntityManagerInterface $doctrineEntityManager */
            if (!$this->isSupportedReplicaManager($managerName)) {
                continue;
            }

            $managers[$managerName] = $doctrineEntityManager;
        }

        return $managers;
    }

    /** @return array<AppEntityManagerInterface> */
    public function getSimiliReplicaManagers(): array
    {
        $managers = [];
        foreach ($this->noDoctrineEntityManagerList as $managerName => $managerClassName) {
            if (!$this->isSupportedReplicaManager($managerName)) {
                continue;
            }

            $managers[$managerName] =
                \array_filter(\iterator_to_array($this->noDoctrineEntityManagers),
                    fn (AppEntityManagerInterface $manager) => $manager::class === $managerClassName
                )[0];
        }

        return $managers;
    }

    private function isSupportedReplicaManager(string $managerName): bool
    {
        $supportedClasses = $this->entityReplicasSupport[$this->entityName];
        $this->handleNotExistingManagerName($supportedClasses);

        return \in_array($managerName, $supportedClasses);
    }

    private function getAllManagers(): array
    {
        $allManagerNames = \array_merge(
            $this->doctrineManagerRegistry->getManagers(),
            $this->noDoctrineEntityManagerList
        );

        return $allManagerNames;
    }

    private function getAllManagerNames(): array
    {
        $allManagerNames = \array_merge(
            \array_keys($this->doctrineManagerRegistry->getManagers()),
            \array_keys($this->noDoctrineEntityManagerList)
        );

        return $allManagerNames;
    }

    private function handleNotExistingManagerName(array $supportedClasses): void
    {
        $diffClass = \array_diff($supportedClasses, $this->getAllManagerNames());
        if (0 !== \count($diffClass)) {
            throw new \DomainException("Manager '".\current($diffClass)."' not handled.");
        }
    }
}
