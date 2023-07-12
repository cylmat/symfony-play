<?php

namespace App\ApiResource\Domain\Model;

final class RandomApi
{
    public int $random_int;
    public int $random_redis;
    public string $cache_get;
    public string $cache_dynamic;
}
