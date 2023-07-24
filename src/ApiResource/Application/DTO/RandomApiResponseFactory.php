<?php

namespace App\ApiResource\Application\DTO;

use App\ApiResource\Domain\Model\RandomApi;
use App\AppBundle\Application\Common\ResponseFactoryInterface;

/** @todo Something better than DTO factory ? */
final class RandomApiResponseFactory implements ResponseFactoryInterface
{
    public function __invoke(RandomApi $randomApi): array
    {
        $data = [
            'id' => $randomApi->random_int,
            'type' => 'redis',
        ];
        foreach ($randomApi as $name => $property) {
            $data[$name] = $property;
        }

        return $data;
    }
}
