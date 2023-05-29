<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\AppClientInterface;
use Predis\Client as PredisPredisClient;

class PredisClient implements AppClientInterface
{
    public function __construct(
        private readonly PredisPredisClient $predis
    ) {
    }

    public function __call(string $name, $arguments): mixed
    {
        return $this->predis->{$name}($arguments);
    }
}
