<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Entity\Log;

final class LogRepository extends AbstractAppRepository
{
    protected const ENTITY_NAME = Log::class;

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
