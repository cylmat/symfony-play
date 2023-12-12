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
class LogRepository extends ServiceEntityRepository
{
    public function __construct(
        private readonly AppEntityRegistry $appEntityManager,
        private readonly AppRepositoryRegistry $appRepositoryRegistry,
    ) {
        parent::__construct($appEntityManager->getDoctrineRegistry(), Log::class); // @phpstan-ignore-line: class-string
    }

    public function flushall() // LOG
    {
        $objectFqcn = $this->_entityName;

        /* @todo integration test this */
        foreach ($this->appEntityManager->getDoctrineRegistry()->getManagers() as $entityManager) {
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

        $this->appRepositoryRegistry->remove($this->getEntityName());
    }

    public function save(Log $entity, bool $flush = false): void
    {
        // to implements
    }

    public function remove(Log $entity, bool $flush = false): void
    {
        // to implements
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
