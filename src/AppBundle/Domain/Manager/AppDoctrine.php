<?php

namespace App\AppBundle\Domain\Manager;

use App\Local\Infrastructure\Manager\RedisPersistanceManager;
use Doctrine\Persistence\ManagerRegistry;

/** @SuppressWarnings(PHPMD.BooleanArgumentFlag) */
class AppDoctrine
{
    /** @var NoDoctrineEntityManagerInterface[] */
    private array $persistanceRegistry = [];

    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        RedisPersistanceManager $redis
    ) {
        $this->persistanceRegistry[] = $redis;
    }

    public function getDoctrineRegistry(): ManagerRegistry
    {
        return $this->doctrineRegistry;
    }

    public function getPersistanceRegistry(): array
    {
        return $this->persistanceRegistry;
    }

    public function persist(object $object): void
    {
        foreach ($this->doctrineRegistry->getManagers() as $entityManager) {
            $entityManager->persist($object);
            $entityManager->flush();
        }

        foreach ($this->persistanceRegistry as $manager) {
            $manager->persist($object);
        }
    }
}
