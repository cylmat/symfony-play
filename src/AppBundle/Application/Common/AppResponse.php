<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

class AppResponse
{
    public function __construct(
        private object $objectData,
    ) {
    }

    public function getObjectData(): object
    {
        return $this->objectData;
    }
}
