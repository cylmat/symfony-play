<?php

namespace App\AppBundle\Infrastructure;

use Doctrine\Persistence\ManagerRegistry;

class AppDoctrine
{
    public function __construct(
        private readonly ManagerRegistry $doctrine
    ) {
    }

    public function persist(object $object): void
    {
        // Doctrine\DBAL\Connection
        // $connection = $this->doctrine->getConnection();

        // Doctrine\DBAL\Schema\SqliteSchemaManager
        // $schema = $connection->getSchemaManager();
        // $params = $connection->getParams();

        $this->doctrine->getManager()->persist($object);
    }

    public function flush(): void
    {
        $this->doctrine->getManager()->flush();
    }
}
