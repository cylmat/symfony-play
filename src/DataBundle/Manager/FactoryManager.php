<?php

namespace App\DataBundle\Manager;

use App\DataBundle\Entity\Factory;
use Doctrine\ORM\EntityManagerInterface;

final class FactoryManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function addFactory(Factory $factory): void
    {
        $this->entityManager->persist($factory);
        $this->entityManager->flush();
    }
}
