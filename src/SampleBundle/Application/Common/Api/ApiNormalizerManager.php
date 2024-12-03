<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common\Api;

use App\SampleBundle\Application\OutputFormatterInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

// @todo Use interface.
/**
 * Api response normalizer
 * Change obect data to jsonify array
 */
final class ApiNormalizerManager implements ApiNormalizerManagerInterface
{
    public function __construct(
        /** @param ApiNormalizerInterface[] $normalizers */
        #[TaggedIterator(ApiNormalizerInterface::TAG)]
        private readonly iterable $normalizers,
        private readonly OutputFormatterInterface $apiFormatter,
    ) {
    }

    public function normalizeResponse(ApiResponseInterface $response): array
    {
        $normalizerFounds = $this->findNormalizer($response);
        // @todo Use ReflectionClass
        $data = $normalizerFounds($response->getData());

        return $this->apiFormatter->format($data);
    }

    private function findNormalizer(ApiResponseInterface $response): ApiNormalizerInterface
    {
        $normalizerFounds = null;
        foreach ($this->normalizers as $normalizer) {
            /** @var ApiNormalizerInterface normalizer */
            if ($normalizer->support(($response->getData())::class)) {
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
