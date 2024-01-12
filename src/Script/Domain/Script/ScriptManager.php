<?php

declare(strict_types=1);

namespace App\Script\Domain\Script;

use App\AppBundle\Domain\DomainManagerInterface;

final class ScriptManager implements DomainManagerInterface
{
    public function __construct(
        private readonly PythonScriptsInterface $pythonScripts,
    ) {
    }

    public function getData(): ScriptModel
    {
        $scripts = new ScriptModel();
        $scripts->pythonResult = $this->pythonScripts->getResult();

        return $scripts;
    }
}
