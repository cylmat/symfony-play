<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common;

use App\SampleBundle\Application\Common\Contracts\ResponseInterface;

abstract class AbstractAction implements ActionInterface
{
    abstract public function execute(AppRequest $request): ResponseInterface;
}
