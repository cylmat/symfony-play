<?php

namespace App\AppBundle\Infrastructure;

/** @todo put in "contracts" directory */
interface AppEntityManagerInterface
{
    public function getClient(): object;

    public function persist(object $object): void;

    public function remove(object $object): void;

    public function flush(): void;

    // @toto implements find($id)
}
