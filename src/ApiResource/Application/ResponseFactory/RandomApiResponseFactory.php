<?php

namespace App\ApiResource\Application\ResponseFactory;

use App\ApiResource\Domain\Model\RandomApi;
use App\AppBundle\Application\Contracts\JsonApiFormatterFactoryInterface;

 /** @todo use Json translator in controller for itself */
final class RandomApiResponseFactory
{
    public function __construct(
        private readonly JsonApiFormatterFactoryInterface $jsonApiFormatterFactory,
    ) {
    }

    public function __invoke(RandomApi $randomApi): array
    {
        $document = $this->jsonApiFormatterFactory->createDocument('api', $randomApi->random_int);

        foreach ($randomApi as $name => $property) {
            $document->add($name, $property);
        }

        return $document->toArray();
    }
}
