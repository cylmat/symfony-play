<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

/**
 * Simple bridge with Doctrine ManagerRegistry
 */
final class AppManagerRegistry
{
    /** @see vendor/doctrine/persistence/src/Persistence/AbstractManagerRegistry.php */
    public function __construct(
        private readonly ManagerRegistry $doctrineManagerRegistry,
    ) {
    }

    // @todo getManagerFor(...)

    public function getTableName(string $entityName): string
    {
        /** @var ObjectManager $manager */
        $manager = $this->doctrineManagerRegistry
            ->getManagerForClass($entityName);

        return $manager->getClassMetadata($entityName)->getTableName();
    }
}
