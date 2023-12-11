<?php

declare(strict_types=1);

namespace App\Data\Application\DTO;

use App\AppBundle\Application\Common\Api\ApiResponseNormalizerInterface;
use App\Data\Domain\Model\RandomApi;

/** @todo Something better than DTO normalizer ? */
final class RandomApiResponseNormalizer implements ApiResponseNormalizerInterface
{
    public function __invoke(RandomApi $randomApi): array
    {
        $data = [
            'id' => $randomApi->random_int,
            'type' => 'script',
        ];
        foreach ($randomApi as $name => $property) {
            $data[$name] = $property;
        }

        return $data;
    }

    public function support(string $type): bool
    {
        return RandomApi::class === $type;
    }
}
