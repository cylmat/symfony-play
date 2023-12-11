<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('response.normalizer')]
interface ResponseNormalizerInterface
{
    // @todo automatic way with __invoke param
    public function support(string $type): bool;
}
