<?php

declare(strict_types=1);

namespace App\AppBundle\Domain\Manager;

interface ScriptManagerInterface
{
    public function getRandomInt(): int;
}
