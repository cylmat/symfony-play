<?php

namespace App\AppData\Infrastructure;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(AppEntityManagerInterface::TAG)]
interface AppEntityManagerInterface
{
    public const TAG = 'app.entity_manager';

    public function getRepository(): AppRepositoryInterface;

    public function save(object $object): void;

    public function remove(object $object): void;
}
