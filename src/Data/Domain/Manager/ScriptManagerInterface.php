<?php

declare(strict_types=1);

namespace App\Data\Domain\Manager;

interface ScriptManagerInterface
{
    public function getRandomInt(): int;
}
