<?php

declare(strict_types=1);

namespace App\Data\Application\DTO;

use App\AppBundle\Application\Common\ResponseFactoryInterface;
use App\Data\Domain\Model\RandomApi;

/** @todo Something better than DTO factory ? */
final class RandomApiResponseNormalizer implements ResponseFactoryInterface
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
}
