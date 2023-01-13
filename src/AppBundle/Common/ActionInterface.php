<?php

namespace App\AppBundle\Common;

interface ActionInterface
{
    /** @todo change response */
    public function execute(AppRequest $request): mixed;
}
