<?php

declare(strict_types=1);

namespace App\MainBundle\Service\Data;

class ClientNull implements ClientInterface
{
    public function __call(string $name, mixed $arguments): mixed
    {
        return null;
    }
}
