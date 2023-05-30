<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\AppClientInterface;

class NullClient implements AppClientInterface
{
    public function __call(string $name, mixed $arguments) // @phpstan-ignore-line: no return type
    {
    }
}
