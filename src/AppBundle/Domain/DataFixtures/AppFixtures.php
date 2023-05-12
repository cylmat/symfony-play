<?php

namespace App\AppBundle\Domain\DataFixtures;

use App\AppBundle\Domain\Entity\Log;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Psr\Log\LogLevel;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $logEntity = (new Log())
            ->setChannel('fixture')
            ->setLevel(LogLevel::DEBUG)
            ->setMessage('test')
        ;
        $manager->persist($logEntity);
        $manager->flush();
    }
}
