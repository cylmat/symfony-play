<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Manager;

use App\AppData\Infrastructure\Redis\RedisManager;
use App\AppData\Domain\Manager\CustomScriptsInterface;

final class CustomScripts implements CustomScriptsInterface
{
    public function __construct(
        private readonly RedisManager $redisManager,
    ) {}

    public function getRandomInt(): int
    {
        return $this->redisManager->getRandomInt();
    }
}
