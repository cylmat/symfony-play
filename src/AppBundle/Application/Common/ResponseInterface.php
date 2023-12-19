<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

interface ResponseInterface
{
    public function getObjectData(): object;
}
