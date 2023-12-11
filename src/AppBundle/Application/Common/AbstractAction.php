<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

abstract class AbstractAction implements ActionInterface
{
    abstract public function execute(AppRequest $request): mixed;
}
