<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Service;

use App\AppData\Infrastructure\Redis\RedisScriptManager;
use App\AppData\Domain\Service\CustomScriptsInterface;

final class CustomScripts implements CustomScriptsInterface
{
    public function __construct(
        private readonly RedisScriptManager $redisManager,
    ) {}

    public function getRandomInt(): int
    {
        return $this->redisManager->getRandomInt();
    }
}
