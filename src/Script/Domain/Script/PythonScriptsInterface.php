<?php

declare(strict_types=1);

namespace App\Script\Domain\Script;

interface PythonScriptsInterface
{
    public function getResult(): mixed;
}
