<?php

namespace App\Text\Application;

use App\AppBundle\Common\AppRequest;
use App\Text\Domain\Manager\SedManager;

class TextAction
{
    public function __construct(
        private SedManager $sedManager
    ) {
    }

    public function execute(AppRequest $request): string
    {
        return $this->sedManager->substituteText($request->text, $request->arguments);
    }
}
