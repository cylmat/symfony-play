<?php

namespace App\AppBundle\Infrastructure;

class NullClient implements AppClientInterface
{
    public function __call($name, $arguments): void
    {
    }
}
