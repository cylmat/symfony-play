<?php

namespace App\Text\Domain\Service;

use Symfony\Component\Process\Process;

// @see https://symfony.com/doc/current/components/process.html
final class SedProcess
{
    /**
     * @param string[] $args
     *
     * @SuppressWarnings(PHPMD)
     */
    public function processText(string $text, array $args): string
    {
        foreach ($args as $argument => $replace) {
            $process = Process::fromShellCommandline('echo "${:TEXT}" | sed -E "${:SUBSTIT}"');
            $process->run(null, ['TEXT' => $text, 'SUBSTIT' => "s/$argument/$replace/"]);
            $text = trim($process->getOutput());
        }

        return $text;
    }
}
