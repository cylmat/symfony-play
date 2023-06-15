<?php

namespace App\AppBundle\Infrastructure\Repository;

use App\AppBundle\Domain\Manager\AppDoctrine;

class AppRepositoryRegistry
{
    public function __construct(
        private readonly AppDoctrine $appDoctrine
    ) {   
    }

    // @todo to implements
}
