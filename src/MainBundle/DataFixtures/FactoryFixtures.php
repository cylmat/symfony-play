<?php

namespace App\MainBundle\DataFixtures;

use App\MainBundle\Entity\Data\Factory;
use App\MainBundle\Repository\Data\FactoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FactoryFixtures extends Fixture
{
    public function __construct(
        FactoryRepository $factoryRepository
    ) {}

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $factory = (new Factory())
            ->setName('Using')
        ;

        $manager->persist($factory);
        $manager->flush();
    }
}
