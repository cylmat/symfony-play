<?php

namespace App\MainBundle\Service\Text;

use Symfony\Component\Process\Process;

// @see https://symfony.com/doc/current/components/process.html
final class SedProcess implements CommandProcessInterface
{
    public const CMD = 'sed';

    /**
     * Replace with arguments ['textpattern' => 'textreplacement'].
     *
     * @param string[][] $args
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function processText(string $text, array $args): string
    {
        $args = $this->flattenArguments($args);

        foreach ($args as $pattern => $replace) {
            $process = Process::fromShellCommandline('echo "${:TEXT}" | '.self::CMD.' -E "${:SUBSTIT}"');
            $process->run(null, ['TEXT' => $text, 'SUBSTIT' => "s/$pattern/$replace/"]);
            $text = trim($process->getOutput());
        }

        return $text;
    }

    /**
     * @param string[][] $arguments
     *
     * @return string[]
     */
    private function flattenArguments(array $arguments): array
    {
        $return = [];
        foreach ($arguments as $argument) {
            $return[$argument['pattern']] = $argument['replace'];
        }

        return $return;
    }
}
