<?php

namespace App\AppBundle\Common;

class Request
{
    /** @param mixed[] $data */
    public function __construct(
        private readonly array $data
    ) {
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name];
    }
}
