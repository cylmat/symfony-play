<?php

namespace App\AppBundle\Infrastructure;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class AppDoctrine
{
    /** @todo: Remove this and use fake Doctrine for tests */
    private const TEST_ENV = 'test';

    /** @var ObjectManager[] */
    private $managers = [];

    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    /** @todo Remove "env" parameters and use config file only */
    public function __construct(
        private readonly ManagerRegistry $doctrine,
        private readonly string $env
    ) {
        $this->managers = $this->doctrine->getManagers();
    }

    public function persist(object $object): void
    {
        /*
         * Sample
         * Doctrine\DBAL\Connection
         * $connection = $this->doctrine->getConnection();
         *
         * Doctrine\DBAL\Schema\SqliteSchemaManager
         * $schema = $connection->getSchemaManager();
         * $params = $connection->getParams();
         */

        if (self::TEST_ENV !== $this->env) {
            foreach ($this->managers as $manager) {
                $manager->persist($object);
            }
        }
    }

    public function flush(): void
    {
        if (self::TEST_ENV !== $this->env) {
            foreach ($this->managers as $manager) {
                $manager->flush();
            }
        }
    }

    public function truncate(): void
    {
        if (self::TEST_ENV !== $this->env) {
            foreach ($this->managers as $manager) {
                $manager->fetchAll();
            }
        }
    }
}
