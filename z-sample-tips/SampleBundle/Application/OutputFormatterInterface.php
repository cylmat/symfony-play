<?php

namespace App\SampleBundle\Application;

interface OutputFormatterInterface
{
    public function format(array $data): array;
}
