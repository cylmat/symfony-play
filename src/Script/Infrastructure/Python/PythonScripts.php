<?php

declare(strict_types=1);

namespace App\Script\Infrastructure\Python;

use App\Script\Domain\Script\PythonScriptsInterface;

final class PythonScripts implements PythonScriptsInterface
{
    public function getResult(): int
    {
        return 1;
    }
}
