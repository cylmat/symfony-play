<?php

namespace App\AppBundle\Infrastructure\Factory;

use alsvanzelf\jsonapi\ResourceDocument;
use App\AppBundle\Infrastructure\Contracts\JsonApiFormatterFactoryInterface;

/** @see https://jsonapi.org/format */
final class DocumentFormatterFactory implements JsonApiFormatterFactoryInterface
{
    public function createDocument(?string $type = null, ?string $id = null): ResourceDocument
    {
        return new ResourceDocument($type, $id);
    }
}
