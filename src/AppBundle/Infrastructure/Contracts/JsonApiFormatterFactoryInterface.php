<?php

namespace App\AppBundle\Infrastructure\Contracts;

use alsvanzelf\jsonapi\ResourceDocument;

interface JsonApiFormatterFactoryInterface
{
    public function createDocument(?string $type = null, ?string $id = null): ResourceDocument;
}
