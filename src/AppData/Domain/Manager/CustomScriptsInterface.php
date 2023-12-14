<?php

declare(strict_types=1);

namespace App\AppData\Domain\Manager;

/** Interface for database scripting. */
interface CustomScriptsInterface
{
    public function getRandomInt(): int;
}
