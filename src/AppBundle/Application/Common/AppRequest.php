<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

final class AppRequest
{
    /** @param mixed[] $data */
    public function __construct(
        private readonly array $data = []
    ) {
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name];
    }
}
