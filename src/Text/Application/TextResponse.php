<?php

declare(strict_types=1);

namespace App\Text\Application;

use App\AppBundle\Application\Common\AppResponse;
use App\AppBundle\Application\Common\Contracts\ResponseInterface;
use App\Text\Domain\Model\TextModel;

final class TextResponse extends AppResponse implements ResponseInterface
{
    public function __construct(
        public readonly TextModel $data,
    ) {
    }
}
