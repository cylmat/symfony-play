<?php

namespace App\Local\Domain;

use App\Local\Infrastructure\RedisClientInterface; /** @todo no infra */

/* @see https://app.redislabs.com */
class RedisManager
{
    public function __construct(
        private readonly RedisClientInterface $redisClient
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
