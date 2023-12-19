<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

use App\AppBundle\Application\Common\Contracts\ModelInterface;

class AppResponse implements ResponseInterface
{
    public function __construct(
        private ModelInterface $objectData,
    ) {
    }

    public function getObjectData(): object
    {
        return $this->objectData;
    }
}
