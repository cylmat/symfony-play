<?php

namespace App\Local\Domain;

use App\AppBundle\Domain\AppClientInterface;

/* @see https://app.redislabs.com */
class RedisManager
{
    public function __construct(
        private readonly AppClientInterface $redisClient
    ) {
    }

    /**
     * @see http://lua-users.org/wiki/MathLibraryTutorial
     * @see https://redis.io/docs/manual/programmability/eval-intro
     * @see https://redis-doc-test.readthedocs.io/en/latest/commands/eval
     */
    public function getLuaRandomInt(): int
    {
        /* @phpstan-ignore-next-line: Client method not exists */
        return (int) $this->redisClient->eval('math.randomseed(ARGV[1]); return math.random(0, 100)', 0, time() * rand());
    }
}
