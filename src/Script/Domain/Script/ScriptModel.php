<?php

declare(strict_types=1);

namespace App\Script\Domain\Script;

use App\AppBundle\Application\Common\Contracts\ModelInterface;

final class ScriptModel implements ModelInterface
{
    public mixed $pythonResult;
}
