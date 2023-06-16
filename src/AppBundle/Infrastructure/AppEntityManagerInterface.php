<?php

namespace App\AppBundle\Infrastructure;

interface AppEntityManagerInterface
{
    public function getClient(): object;

    public function persist(object $object): void;

    public function remove(object $object): void;

    public function flush(): void;

    // @toto impelments find($id)
}
