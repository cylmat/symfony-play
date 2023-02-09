<?php

namespace App\AppBundle\Common;

abstract class AbstractAction implements ActionInterface
{
    abstract public function execute(AppRequest $request): mixed;

    /** @param mixed[] $requestData */
    public function executeRequest(array $requestData): mixed
    {
        return $this->execute(new AppRequest($requestData));
    }
}
