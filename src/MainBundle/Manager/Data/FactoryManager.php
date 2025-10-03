<?php

namespace App\MainBundle\Manager\Data;

use App\MainBundle\Entity\Contact;
use App\MainBundle\Entity\Factory;
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
