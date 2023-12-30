<?php

declare(strict_types=1);

namespace App\Data\Domain\Redis;

interface RedisScriptsInterface
{
    public function getRandomInt(): int;
}
