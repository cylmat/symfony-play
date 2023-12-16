<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Entity\Log;
use App\AppData\Infrastructure\Manager\AppEntityRegistry;
use App\AppData\Infrastructure\Manager\AppRepositoryRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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

    public function __construct(
        private readonly AppEntityRegistry $appRegistry,
        private readonly AppRepositoryRegistry $appRepositoryRegistry,
    ) {
        parent::__construct($appRegistry->getDoctrine(), static::ENTITY_NAME);

        $this->appRepositoryRegistry->setEntityName(static::ENTITY_NAME);
    }

    /** find(), findBy() and findAll() inherited... */

    public function setManagersSupport(string $main, array $replicas = [], array $noDoctrine = []): void
    {
        $this->appRepositoryRegistry->setManagersSupport($main, $replicas, $noDoctrine);
    }

    public function flushall(): void
    {
        $this->appRepositoryRegistry->flushall();
    }
}
