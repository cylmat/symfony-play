<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Domain\Manager\AppDoctrine;
use App\Local\Infrastructure\Manager\RedisRepositoryManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
    public function __construct(
        private readonly AppDoctrine $appDoctrine,
        private readonly RedisRepositoryManager $redisRepository // @todo iterable
    ) {
        parent::__construct($appDoctrine->getDoctrineRegistry(), Log::class); // @phpstan-ignore-line: class-string
    }

    public function flushall() // LOG
    {
        $objectFqcn = $this->_entityName;

        foreach ($this->appDoctrine->getDoctrineRegistry()->getManagers() as $entityManager) {
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

        $this->redisRepository->initialize($this->getEntityName());
        $entities = $this->redisRepository->findAll();
        foreach ($entities as $entity) {
            $this->redisRepository->getPersistanceManager()->remove($entity);
        }
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
