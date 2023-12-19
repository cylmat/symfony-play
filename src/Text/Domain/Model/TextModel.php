<?php

namespace App\Text\Domain\Model;

use App\AppBundle\Application\Common\Contracts\ModelInterface;

final class TextModel implements ModelInterface
{
    public function __construct(
        public readonly string $text,
    ) {
    }
}
