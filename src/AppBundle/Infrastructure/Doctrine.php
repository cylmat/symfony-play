<?php

namespace App\AppBundle\Infrastructure;

use Doctrine\Persistence\ManagerRegistry;

class Doctrine
{
    public function __construct(
        private readonly ManagerRegistry $doctrine
    ) {
    }

    public function persist(object $object)
    {
        // Doctrine\DBAL\Connection
        $connection = $this->doctrine->getConnection();
        // Doctrine\DBAL\Schema\SqliteSchemaManager
        $schema = $connection->getSchemaManager();
        $params = $connection->getParams();
        d( $connection->getParams());
        $this->doctrine->getManager()->persist($object);
    }

    public function flush()
    {
        $this->doctrine->getManager()->flush();
    }
}
