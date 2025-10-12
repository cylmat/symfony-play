<?php

namespace App\MainBundle\Service\Text;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

/** @todo see how to use it in domain layer */

/** @see https://symfony.com/doc/current/service_container/tags.html */
#[AutoconfigureTag('app.command_process')]
interface CommandProcessInterface
{
    public const CMD = '';

    /** @param string[][] $args */
    public function processText(string $text, array $args): string;
}
