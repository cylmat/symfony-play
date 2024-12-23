<?php

namespace App\Common\DataFixtures;

use App\DataBundle\Entity\Factory;
use App\DataBundle\Repository\FactoryRepository;
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
