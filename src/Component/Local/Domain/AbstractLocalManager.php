<?php

namespace App\Local\Domain;

abstract class AbstractLocalManager
{
    public function __construct(
        /* @phpstan-ignore-next-line "never read" */
        private readonly bool $isLocal
    ) {
    }
}
