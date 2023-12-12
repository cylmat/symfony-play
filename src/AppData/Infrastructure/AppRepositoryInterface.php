<?php

namespace App\AppData\Infrastructure;

interface AppRepositoryInterface
{
    public function initialize(string $entityName): self;

    public function getEntityManager(): AppEntityManagerInterface;

    public function findAll(): array;
}
