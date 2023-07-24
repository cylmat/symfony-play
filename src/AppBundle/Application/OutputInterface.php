<?php

namespace App\AppBundle\Application;

interface OutputInterface
{
    public function format(array $data): array;

    public function validate(string $json): void;
}
