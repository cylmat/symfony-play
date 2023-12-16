<?php

namespace App\AppData\Infrastructure;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(AppEntityManagerInterface::TAG)]
interface AppEntityManagerInterface
{
    public const TAG = 'app.entity_manager';

    public function getClient(): ClientInterface;

    public function save(object $object): void;

    public function remove(object $object): void;

    // @todo implements find($id)
    // @todo implements findAll($query)
}
