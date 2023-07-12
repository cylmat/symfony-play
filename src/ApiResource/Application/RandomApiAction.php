<?php

namespace App\ApiResource\Application;

use App\ApiResource\Application\ResponseFactory\RandomApiResponseFactory;
use App\ApiResource\Domain\RandomApiManager;
use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;

final class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RandomApiManager $randomApiManager,
        private readonly RandomApiResponseFactory $randomFactory,
    ) {
    }

    public function execute(AppRequest $request): mixed
    {
        return ($this->randomFactory)($this->randomApiManager->getData());
    }
}
