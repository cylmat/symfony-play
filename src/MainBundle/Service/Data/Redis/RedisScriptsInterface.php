<?php

declare(strict_types=1);

namespace App\MainBundle\Service\Data\Redis;

interface RedisScriptsInterface
{
    public function getRandomInt(): int;
}