<?php

declare(strict_types=1);

namespace App\Local\Infrastructure;

/**
 * @method del(array|string $keyOrKeys, ...$keys): int;
 * @method keys(string $pattern): array;
 * @method set(string $key, $value, $expireResolution = null, $expireTTL = null, $flag = null): Status;
 */
interface RedisClientInterface
{
}
