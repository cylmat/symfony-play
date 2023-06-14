<?php

namespace App\AppBundle\Infrastructure\Repository;

interface NoDoctrineEntityManagerInterface
{
    public function persist(object $object): void;
    public function remove(object $object): void;
    public function findAll(): void;
}