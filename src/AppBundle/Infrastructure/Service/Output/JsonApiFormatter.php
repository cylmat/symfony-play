<?php

namespace App\AppBundle\Infrastructure\Service\Output;

use alsvanzelf\jsonapi\ResourceDocument;

final class JsonApiFormatter implements FormatterInterface
{
    public function format($data): array
    {
        $document = new ResourceDocument($data['type'], $data['id']);
        unset($data['id']);
        unset($data['type']);

        foreach ($data as $k => $v) {
            $document->add($k, $v);
        }

        return $document->toArray();
    }
}
