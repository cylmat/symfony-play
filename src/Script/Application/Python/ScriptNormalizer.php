<?php

declare(strict_types=1);

namespace App\Script\Application\Python;

use App\AppBundle\Application\Common\Api\ApiNormalizerInterface;
use App\Script\Domain\Script\ScriptModel;

final class ScriptNormalizer implements ApiNormalizerInterface
{
    public function __invoke(ScriptModel $scriptModel): array
    {
        $data = [
            'id' => $scriptModel->pythonResult,
            'type' => 'script',
        ];
        foreach ($scriptModel as $name => $property) {
            $data[$name] = $property;
        }

        return $data;
    }

    public function support(string $dataType): bool
    {
        return ScriptModel::class === $dataType;
    }
}
