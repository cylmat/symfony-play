<?php

declare(strict_types=1);

namespace App\Data\Domain\Manager;

/**
 * Interface for database scripting.
 */
interface CustomScriptInterface
{
    public function getCustomScript(array $args): mixed;
}
