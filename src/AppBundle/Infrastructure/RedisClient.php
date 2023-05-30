<?php

namespace App\AppBundle\Infrastructure;

use App\AppBundle\Domain\AppClientInterface;
use Predis\Client as PredisClient;

class RedisClient implements AppClientInterface
{
    private PredisClient $predis;

    public function __construct(
        string $redisUrl
    ) {
        $this->predis = new PredisClient($redisUrl);
    }

    public function __call(string $name, mixed $arguments)
    {
        return $this->predis->{$name}($arguments);
    }

}
