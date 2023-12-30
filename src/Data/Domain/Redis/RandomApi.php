<?php

declare(strict_types=1);

namespace App\Data\Domain\Redis;

use App\AppBundle\Application\Common\Contracts\ModelInterface;

final class RandomApi implements ModelInterface
{
    public int $random_int;
    public int $random_script_int;
    public string $cache_get;
    public string $cache_dynamic;
}
