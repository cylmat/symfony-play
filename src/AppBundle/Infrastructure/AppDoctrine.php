<?php

namespace App\AppBundle\Infrastructure;

use Doctrine\Persistence\ManagerRegistry;

class AppDoctrine
{
    /** @todo: Remove this and use fake Doctrine for tests */
    private const TEST_ENV = 'test';

    /** @todo Remove "env" parameters */
    public function __construct(
        private readonly ManagerRegistry $doctrine,
        private readonly string $env
    ) {
    }

    public function persist(object $object): void
    {
        // Doctrine\DBAL\Connection
        // $connection = $this->doctrine->getConnection();

        // Doctrine\DBAL\Schema\SqliteSchemaManager
        // $schema = $connection->getSchemaManager();
        // $params = $connection->getParams();

        if (self::TEST_ENV !== $this->env) {
            $this->doctrine->getManager()->persist($object);
        }
    }

    public function flush(): void
    {
        if (self::TEST_ENV !== $this->env) {
            $this->doctrine->getManager()->flush();
        }
    }
}
