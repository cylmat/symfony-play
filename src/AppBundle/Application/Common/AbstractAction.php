<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

use App\AppBundle\Application\Common\Contracts\ResponseInterface;

abstract class AbstractAction implements ActionInterface
{
    abstract public function execute(AppRequest $request): ResponseInterface;
}
