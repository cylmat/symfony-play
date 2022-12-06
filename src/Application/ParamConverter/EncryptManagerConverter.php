<?php

namespace App\Application\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @description SAMPLE
 */
class EncryptManagerConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration)
    {
        // ...
    }

    public function supports(ParamConverter $configuration): bool
    {
        return $configuration->getClass() === EncryptManagerConverter::class;
    }
}
