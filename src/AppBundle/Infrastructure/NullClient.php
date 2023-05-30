<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\AppClientInterface;

class NullClient implements AppClientInterface
{
    /** @param mixed $arguments */
    public function __call(string $name, mixed $arguments)
    {
    }
}
