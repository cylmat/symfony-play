<?php

namespace App\SampleBundle\Application;

interface OutputValidatorInterface
{
    public function validate(string $json): void;
}
