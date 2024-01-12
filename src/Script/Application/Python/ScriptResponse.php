<?php

declare(strict_types=1);

namespace App\Script\Application\Python;

use App\AppBundle\Application\Common\Api\ApiResponse;
use App\AppBundle\Application\Common\Api\ApiResponseInterface;
use App\Script\Domain\Script\ScriptModel;

final class ScriptResponse extends ApiResponse implements ApiResponseInterface
{
    public function __construct(
        public readonly ScriptModel $data,
    ) {
    }
}
