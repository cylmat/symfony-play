<?php

namespace App\AppBundle\Infrastructure\Contracts;

interface JsonApiValidatorInterface
{
    public function validate(string $json): void;
}
