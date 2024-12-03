<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common;

use App\SampleBundle\Application\Common\Contracts\ModelInterface;
use App\SampleBundle\Application\Common\Contracts\ResponseInterface;

abstract class AppResponse implements ResponseInterface
{
    // @todo Remove this and use ReflectionClass !
    public function getData(): ModelInterface
    {
        return $this->data;
    }
}
