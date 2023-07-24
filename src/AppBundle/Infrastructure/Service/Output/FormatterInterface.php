<?php

namespace App\AppBundle\Infrastructure\Service\Output;

interface FormatterInterface
{
    public function format(array $data): array;
}
