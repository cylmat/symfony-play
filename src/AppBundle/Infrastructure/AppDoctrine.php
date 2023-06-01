<?php

namespace App\AppBundle\Infrastructure;

use App\Local\Domain\Entity\RedisLog;
use App\Local\Infrastructure\Manager\RedisPersistanceManager;
use Doctrine\Persistence\ManagerRegistry;

/** @SuppressWarnings(PHPMD.BooleanArgumentFlag) */
class AppDoctrine
{
    /**
     * @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php
     *
     * @todo Remove "env" parameters and use config file only
     *
     * @param string[][] $replicateEntities
     */
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        private RedisPersistanceManager $rpm,
        private readonly array $replicateEntities
    ) {
    }

    public function persist(object $object, bool $flush = false): void
    {
        $this->classManagerPersist($object, $flush);
        $this->replicateEntities($object, $flush);
    }

    private function classManagerPersist(object $object, bool $flush = false): void
    {
        if ($object instanceof RedisLog) {
            $this->rpm->persist($object);

            return;
        }

        /*
         * Sample
         * Doctrine\DBAL\Connection
         * $connection = $this->doctrine->getConnection();
         *
         * Doctrine\DBAL\Schema\SqliteSchemaManager
         * $schema = $connection->getSchemaManager();
         * $params = $connection->getParams();
         */

        $this->doctrineRegistry->getManagerForClass($object::class)?->persist($object);
        $flush ? $this->doctrineRegistry->getManagerForClass($object::class)?->flush() : null;
    }

    private function replicateEntities(object $object, bool $flush = false): void
    {
        if (!isset($this->replicateEntities[\get_class($object)])) {
            return;
        }

        foreach ($this->replicateEntities[\get_class($object)] as $entityName) {
            $obj2 = new $entityName();
            $meths = get_class_methods($object);
            $meths = array_filter(
                $meths,
                fn (string $value) => false !== \strpos($value, 'get') && false === \strpos($value, 'getId')
            );

            foreach ($meths as $get) {
                $set = \str_replace('get', 'set', $get);
                $obj2->{$set}($object->{$get}());
            }

            $this->classManagerPersist($obj2, $flush);
        }
    }
}
