<?php

declare(strict_types=1);

namespace App\MainBundle\Manager\Data\Redis;

final class RandomApi
{
    public int $random_int;
    public int $random_script_int;
    public string $cache_get;
    public string $cache_dynamic;
}
