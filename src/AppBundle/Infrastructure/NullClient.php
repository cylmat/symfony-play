<?php

namespace App\AppBundle\Infrastructure;

class NullClient implements AppClientInterface
{
    /** @param mixed $arguments */
    public function __call(string $name, $arguments): void
    {
    }
}
