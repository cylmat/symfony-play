<?php

namespace App\AppBundle\Application\Contracts;

interface JsonApiValidatorInterface
{
    public function validate(string $json): void;
}
