<?php

namespace App\Local\Domain\Manager;

interface RedisManagerInterface
{
    public function getLuaRandomInt(): int;
}
