<?php

declare(strict_types=1);

namespace App\Data\Infrastructure\Manager;

use App\Data\Domain\Manager\ScriptManagerInterface;
use App\Data\Infrastructure\RedisClientInterface;

/** @see https://app.redislabs.com */
final class RedisManager implements ScriptManagerInterface
{
    public function __construct(
        private readonly RedisClientInterface $redisClient,
    ) {
    }

    /**
     * @see http://lua-users.org/wiki/MathLibraryTutorial
     * @see https://redis.io/docs/manual/programmability/eval-intro
     * @see https://redis-doc-test.readthedocs.io/en/latest/commands/eval
     */
    public function getRandomInt(): int
    {
        /** @phpstan-ignore-next-line: Client method not exists */
        return (int) $this->redisClient->eval('math.randomseed(ARGV[1]); return math.random(0, 100)', 0, time() * rand());
    }
}
