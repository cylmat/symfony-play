<?php

declare(strict_types=1);

namespace App\Data\Infrastructure\Redis;

use App\Data\Infrastructure\ClientInterface;

/**
 * @method del(array|string $keyOrKeys, ...$keys): int;
 * @method keys(string $pattern): array;
 * @method set(string $key, $value, $expireResolution = null, $expireTTL = null, $flag = null): Status;
 */
interface RedisClientInterface extends ClientInterface
{
}
