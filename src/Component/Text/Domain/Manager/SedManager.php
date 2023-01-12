<?php

namespace App\Component\Text\Domain\Manager;

use App\Text\Domain\Service\SedProcess;

class SedManager
{
    public function __construct(
        private readonly SedProcess $process
    ) {
    }

    /** @param string[] $arguments */
    public function substituteText(string $text, array $arguments): string
    {
        return $this->process->processText($text, $arguments);
    }
}
