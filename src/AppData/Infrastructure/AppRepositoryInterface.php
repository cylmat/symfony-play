<?php

namespace App\AppData\Infrastructure;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(AppRepositoryInterface::TAG)]
interface AppRepositoryInterface
{
    public const TAG = 'app.repository';

    public function initialize(string $entityName): self;

    public function getEntityManager(): AppEntityManagerInterface;

    public function findAll(): array;
}
