<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common\Contracts;

interface ResponseInterface
{
    public function getData(): ModelInterface;
}
