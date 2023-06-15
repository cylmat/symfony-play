<?php

namespace App\AppBundle\Infrastructure;

interface AppEntityManagerInterface
{
    public function persist(object $object): void;

    public function remove(object $object): void;
}
