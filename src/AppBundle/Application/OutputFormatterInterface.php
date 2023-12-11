<?php

namespace App\AppBundle\Application;

interface OutputFormatterInterface
{
    public function format(array $data): array;
}
