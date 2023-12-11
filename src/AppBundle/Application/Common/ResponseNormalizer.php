<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class ResponseNormalizer
{
    public function __construct(
        /** @param ResponseNormalizerInterface[] $normalizers */
        #[TaggedIterator('response.normalizer')]
        private readonly iterable $normalizers
    ) {
    }

    public function normalize(ResponseInterface $response): array
    {
        foreach ($this->normalizers as $normalizer) {
            /** @var ResponseNormalizerInterface normalizer */
            if ($normalizer->support($response::class)) {
                return $normalizer($response);
            }
        }
    }
}
