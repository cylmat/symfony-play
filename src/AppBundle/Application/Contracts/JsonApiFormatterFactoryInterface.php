<?php

namespace App\AppBundle\Application\Contracts;

use alsvanzelf\jsonapi\ResourceDocument; // todo set to infra

interface JsonApiFormatterFactoryInterface
{
    public function createDocument(?string $type = null, ?string $id = null): ResourceDocument;
}
