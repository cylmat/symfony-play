<?php

namespace App\AppBundle\DataFixtures;

use App\AppBundle\Entity\Log;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $logEntity = new Log();
        $manager->persist($logEntity);

        $manager->flush();
    }
}
