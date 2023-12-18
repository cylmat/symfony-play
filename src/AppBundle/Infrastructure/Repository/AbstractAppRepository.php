<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Entity\Log;
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
    ) {
        $this->entityName = static::ENTITY_NAME; // Use once.
        $this->appSupportRegistry->setEntityName($this->entityName);

        parent::__construct($doctrineManagerRegistry, $this->entityName);
    }

    /** find(), findBy() and findAll() inherited... */

    public function flushAll(): void
    {
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
        foreach ($this->appSupportRegistry->getSimiliReplicaDoctrineManagers() as $similiManager) {
            foreach ($entities as $entity) {
                $similiManager->getRepository()->setEntityName($entity::class)->flushAll();
            }
        }
    }
}
