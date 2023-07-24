<?php

namespace App\AppBundle\Infrastructure\Service\Output;

interface ValidatorInterface
{
    public function validate(string $data): void;
}
