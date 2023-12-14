<?php

namespace App\AppData\Infrastructure;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(AppRepositoryInterface::TAG)]
interface AppRepositoryInterface
{
    public const TAG = 'app.repository';

    public function setEntityName(string $entityName): self;

    public function findAll(): array;

    public function remove(object $entity): void;
}
