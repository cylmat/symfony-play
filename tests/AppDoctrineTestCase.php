<?php

namespace App\Tests;

use App\AppBundle\Domain\Manager\AppDoctrine;

class AppDoctrineTestCase extends AppDoctrine
{
    public function persist(object $object, bool $flush = false): void
    {
        // no action for integration tests
    }
}
