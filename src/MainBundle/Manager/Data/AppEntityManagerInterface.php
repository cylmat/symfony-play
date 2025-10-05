<?php

namespace App\MainBundle\Manager\Data;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(AppEntityManagerInterface::TAG)]
interface AppEntityManagerInterface
{
    public const TAG = 'app.entity_manager';

    public function getRepository();

    public function save(object $object): void;

    public function remove(object $object): void;
}
