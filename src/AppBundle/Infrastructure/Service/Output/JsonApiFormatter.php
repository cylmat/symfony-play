<?php

declare(strict_types=1);

namespace App\AppBundle\Infrastructure\Service\Output;

use alsvanzelf\jsonapi\ResourceDocument;
use App\AppBundle\Application\OutputFormatterInterface;

final class JsonApiFormatter implements OutputFormatterInterface
{
    public function format(array $data): array
    {
        $document = new ResourceDocument($data['type'], $data['id']);
        unset($data['id']);
        unset($data['type']);

        foreach ($data as $k => $v) {
            $document->add($k, $v);
        }

        $array = $document->toArray();
        unset($array['jsonapi']);

        return $array;
    }
}
