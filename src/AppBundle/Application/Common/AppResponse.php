<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

use App\AppBundle\Application\Common\Contracts\ModelInterface;
use App\AppBundle\Application\Common\Contracts\ResponseInterface;

abstract class AppResponse implements ResponseInterface
{
    // @todo Remove this and use ReflectionClass !
    public function getData(): ModelInterface
    {
        return $this->data;
    }
}
