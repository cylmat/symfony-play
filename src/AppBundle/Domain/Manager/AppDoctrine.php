<?php

namespace App\AppBundle\Domain\Manager;

use App\Local\Infrastructure\Manager\RedisPersistanceManager;
use Doctrine\Persistence\ManagerRegistry;

/** Used for replication */
/** @SuppressWarnings(PHPMD.BooleanArgumentFlag) */
class AppDoctrine
{
    /**
     * @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php
     */
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        private readonly RedisPersistanceManager $redis,
        //private readonly array $replicateEntities = [],
        //private readonly iterable $appRepositories = [],
    ) {
    }

    public function getDoctrineRegistry(): ManagerRegistry
    {
        return $this->doctrineRegistry;
    }

    public function persist(object $object, bool $flush = false): void
    {
        $entityManager = $this->doctrineRegistry->getManagerForClass($object::class);
        $othersDoctrineManagers = \array_diff_key($this->doctrineRegistry->getManagers(), ['default' => null]);
        //d($othersDoctrineManagers);
        $this->redis->persist($object);
        //d($othersDoctrineManagers, get_class($entityManager));
       // $this->repositoryPersist($object, $flush); // for root entity
        //$this->replicateEntities($object, $flush);
    }

  /*  private function repositoryPersist(object $object, bool $flush = false): void
    {
        /*
         * Sample :
         * $connection = $this->doctrine->getConnection(); # Doctrine\DBAL\Connection
         * $schema = $connection->getSchemaManager(); # Doctrine\DBAL\Schema\SqliteSchemaManager
         *
        $attributes = (new \ReflectionClass($object))->getAttributes();
        $stdClass = \array_filter($attributes, fn ($attribute)
            => false !== \strpos($attribute->getName(), \stdClass::class)
        )[0] ?? null;

        $repository = null;
        if ($stdClass) {
            $repository = $this->appRepositories[$stdClass->getArguments()['repositoryClass']];
        }

        $repository = $repository ?? $this->doctrineRegistry->getRepository($object::class);
    }*/

    /*private function replicateEntities(object $object, bool $flush = false): void
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

            $this->repositoryPersist($obj2, $flush);
        }
    }*/
}
