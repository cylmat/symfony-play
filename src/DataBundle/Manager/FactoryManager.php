<?php

namespace App\DataBundle\Manager;

use App\DataBundle\Entity\Contact;
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


    public function deleteFactory(Factory $factory): void
    {
        $this->entityManager->remove($factory);
        $this->entityManager->flush();
    }

    public function getAllData(): array
    {
        return [
            'factories' => $this->entityManager->getRepository(Factory::class)->findAll(),
            'contacts' => $this->entityManager->getRepository(Contact::class)->findAll(),
        ];
    }
}
