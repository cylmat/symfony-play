<?php

declare(strict_types=1);

namespace App\Data\Domain\Service;

/** Interface for database scripting. */
interface CustomScriptsInterface
{
    public function getRandomInt(): int;
}
