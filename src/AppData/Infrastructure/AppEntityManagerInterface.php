<?php

namespace App\AppData\Infrastructure;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(AppEntityManagerInterface::TAG)]
interface AppEntityManagerInterface
{
    public const TAG = 'app.entity_manager';

    public function getClient(): object;

    public function persist(object $object): void;

    public function remove(object $object): void;

    public function flush(): void;

    // @toto implements find($id)
}
