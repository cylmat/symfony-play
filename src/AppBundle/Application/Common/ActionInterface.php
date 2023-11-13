<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

interface ActionInterface
{
    /** @todo change response */
    public function execute(AppRequest $request): mixed;
}
