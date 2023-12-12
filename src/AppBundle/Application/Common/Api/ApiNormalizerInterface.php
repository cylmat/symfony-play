<?php

declare(strict_types=1);

namespace App\AppBundle\Application\Common\Api;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(ApiNormalizerInterface::TAG)]
interface ApiNormalizerInterface
{
    public const TAG = 'api.response.normalizer';

    // @todo automatic way with __invoke param
    public function support(string $type): bool;
}
