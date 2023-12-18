<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Entity\Log;
use App\AppData\Infrastructure\Manager\AppRepositoryRegistry;
use App\AppData\Infrastructure\Manager\AppSupportRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Log>
 *
 * @method Log|null find($id, $lockMode = null, $lockVersion = null)
 * @method Log|null findOneBy(array $criteria, array $orderBy = null)
 * @method Log[]    findAll()
 * @method Log[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * createQueryBuilder($alias, $indexBy = null)
 * createNamedQuery($queryName)
 * getEntityManager(): EntityManager
 *
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
abstract class AbstractAppRepository extends ServiceEntityRepository
{
    protected const ENTITY_NAME = '';

    protected string $entityName;

    public function __construct(
        private readonly ManagerRegistry $doctrineManagerRegistry,
        private readonly AppSupportRegistry $appSupportRegistry,
        private readonly AppRepositoryRegistry $appRepositoryRegistry,
    ) {
        $this->entityName = static::ENTITY_NAME; // Use once.

        parent::__construct($doctrineManagerRegistry, $this->entityName);
    }

    /** find(), findBy() and findAll() inherited... */

    public function flushAll(): void
    {
        $this->appSupportRegistry->setEntityName($this->entityName);

        /** @todo integration test this */
        $defaultEntityManager = $this->appSupportRegistry->getDefaultDoctrineManager();
        $entities = $defaultEntityManager->createQueryBuilder()
                ->select('l')
                ->from($this->entityName, 'l')
                ->getQuery()
                ->execute();

        $replicaDoctrineManagers = $this->appSupportRegistry->getReplicaDoctrineManagers();
        foreach ($replicaDoctrineManagers as $entityManager) {
            foreach ($entities as $entity) {
                $entityManager->remove($entity);
            }
        }

        $defaultEntityManager->flush();

        // no-doctrine
        foreach ($this->appRepositoryRegistry as $repository) {
            foreach ($entities as $entity) {
                $repository->setEntityName($entity::class)->flushAll();
            }
        }
    }
}
