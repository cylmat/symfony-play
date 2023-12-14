<?php

declare(strict_types=1);

namespace App\AppData\Application\DTO;

use App\AppBundle\Application\Common\Api\ApiNormalizerInterface;
use App\AppData\Domain\Model\RandomApi;

final class RandomApiNormalizer implements ApiNormalizerInterface
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

    public function support(string $dataType): bool
    {
        return RandomApi::class === $dataType;
    }
}
