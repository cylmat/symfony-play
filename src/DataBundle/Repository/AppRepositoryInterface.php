<?php

namespace App\DataBundle\Repository;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(AppRepositoryInterface::TAG)]
interface AppRepositoryInterface
{
    public const TAG = 'app.repository';

    /** Called from AbstractAppRepository */
    public function setEntityName(string $entityName): self;

    public function flushAll(): void;

    public function truncate(): void;
}
