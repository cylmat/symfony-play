<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Entity\Log;
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
class LogRepository extends ServiceEntityRepository
{
    public function __construct(
        private readonly AppRepositoryRegistry $appRepositoryRegistry,
    ) {
        $this->appRepositoryRegistry->setEntityName(Log::class);
    }

    public function flushall() // LOG
    {
        $this->appRepositoryRegistry->flushall();
    }

    public function save(Log $entity, bool $flush = false): void
    {
        // to implements ...
    }

    public function remove(Log $entity, bool $flush = false): void
    {
        // to implements ...
    }

    /*
    // @return Log[] Returns an array of Log objects
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ->getOneOrNullResult()
        ;
    }
    */
}
