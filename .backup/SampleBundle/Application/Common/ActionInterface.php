<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common;

use App\SampleBundle\Application\Common\Contracts\ResponseInterface;

interface ActionInterface
{
    /** @todo change to __invoke */
    public function execute(AppRequest $request): ResponseInterface;
}
