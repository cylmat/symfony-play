<?php

namespace App\AppBundle\Application;

interface OutputValidatorInterface
{
    public function validate(string $json): void;
}
