<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Entity\Log;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Log>
 *
 * @method Log|null find($id, $lockMode = null, $lockVersion = null)
 * @method Log|null findOneBy(array $criteria, array $orderBy = null)
 * @method Log[]    findAll()
 * @method Log[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *                  -
 *                  createQueryBuilder($alias, $indexBy = null)
 *                  createNamedQuery($queryName)
 *                  getEntityManager(): EntityManager
 *
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
class LogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, ?string $class = null)
    {
        parent::__construct($registry, $class ?? Log::class); // @phpstan-ignore-line: class-string
    }

    public function save(Log $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Log $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
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
