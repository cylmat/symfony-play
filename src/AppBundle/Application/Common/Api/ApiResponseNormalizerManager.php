<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common\Api;

use App\AppBundle\Application\OutputFormatterInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

// @todo Use interface.
/**
 * Api response normalizer
 * Change obect data to jsonify array
 */
final class ApiResponseNormalizerManager implements ApiResponseNormalizerManagerInterface
{
    public function __construct(
        /** @param ApiResponseNormalizerInterface[] $normalizers */
        #[TaggedIterator(ApiResponseNormalizerInterface::TAG)]
        private readonly iterable $normalizers,
        private readonly OutputFormatterInterface $apiFormatter,
    ) {
    }

    public function normalizeResponse(ApiResponseInterface $response): array
    {
        $normalizerFounds = $this->findNormalizer($response);
        $data = $normalizerFounds($response);

        return $this->apiFormatter->format($data);
    }

    private function findNormalizer(ApiResponseInterface $response): ApiResponseNormalizerInterface
    {
        $normalizerFounds = null;
        foreach ($this->normalizers as $normalizer) {
            /** @var ApiResponseNormalizerInterface normalizer */
            if ($normalizer->support($response::class)) {
                $normalizerFounds = $normalizer;
            }
        }

        if (!$normalizerFounds) {
            // @todo Throws DomainLayer exception.
            throw new \DomainException("Response '".$response::class."' not handled by normalizer.");
        }

        return $normalizerFounds;
    }
}
