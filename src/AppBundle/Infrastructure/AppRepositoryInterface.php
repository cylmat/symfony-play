<?php

namespace App\AppBundle\Infrastructure;

interface AppRepositoryInterface
{
    public function initialize(string $entityName);

    public function getEntityManager(): AppEntityManagerInterface;

    public function findAll(): array;
}
