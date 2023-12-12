<?php

declare(strict_types=1);

namespace App\AppData\Infrastructure\Redis;

use App\AppData\Infrastructure\ClientNull;

final class RedisClientNull extends ClientNull implements RedisClientInterface
{
}
