<?php

namespace App\AppBundle\Domain\Manager;

use App\AppBundle\Domain\Entity\Log;
use App\Local\Infrastructure\Manager\RedisPersistanceManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/** @SuppressWarnings(PHPMD.BooleanArgumentFlag) */
class AppDoctrine
{
    /** @var NoDoctrineEntityManagerInterface[] */
    private array $persistanceManagers = [];

    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        RedisPersistanceManager $redis
    ) {
        $this->persistanceManagers[] = $redis;
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

        foreach ($this->persistanceManagers as $manager) {
            $manager->persist($object);
        }
    }

    public function flushall(string $objectFqcn): void
    {
        // @todo set this into a global repository
        foreach ($this->doctrineRegistry->getManagers() as $entityManager) {
            /** @var QueryBuilder $queryBuilder */
            $entities = $entityManager->createQueryBuilder()
                ->select('l')
                ->from($objectFqcn, 'l')
                ->getQuery()
                ->execute();

            foreach ($entities as $e) {
                $entityManager->remove($e);
            }
            $entityManager->flush();
        }

        $tablename = $this->doctrineRegistry
            ->getManagerForClass($objectFqcn)
            ->getClassMetadata($objectFqcn)->getTableName();
    
        foreach ($this->persistanceManagers as $manager) {
            $manager->flushall($tablename);
        }
    }
}
