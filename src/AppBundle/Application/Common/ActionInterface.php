<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

interface ActionInterface
{
    /** @todo change to __invoke */
    public function execute(AppRequest $request): ResponseInterface;
}
