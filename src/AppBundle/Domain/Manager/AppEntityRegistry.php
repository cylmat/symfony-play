<?php

namespace App\AppBundle\Domain\Manager;

use App\Contracts\Infrastructure\Manager\EntityManagerInterface;
use App\Local\Infrastructure\Manager\RedisEntityManager;
use Doctrine\Persistence\ManagerRegistry;

/** @SuppressWarnings(PHPMD.BooleanArgumentFlag) */
class AppEntityRegistry
{
    /** @var EntityManagerInterface[] */
    private array $persistanceEntityRegistry = [];

    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        RedisEntityManager $redis //@todo iterable AppEntityManagerInterface
    ) {
        $this->persistanceEntityRegistry[] = $redis;
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
        }
    }
}
