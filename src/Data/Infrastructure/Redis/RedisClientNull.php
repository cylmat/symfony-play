<?php

declare(strict_types=1);

namespace App\Data\Infrastructure\Redis;

use App\Data\Infrastructure\ClientNull;

final class RedisClientNull extends ClientNull implements RedisClientInterface
{
}
