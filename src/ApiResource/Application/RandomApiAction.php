<?php

declare(strict_types=1);

namespace App\ApiResource\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Application\Common\Api\ApiResponse;
use App\AppData\Domain\Manager\RandomApiManager;

final class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RandomApiManager $randomApiManager,
    ) {
    }

    public function execute(AppRequest $request): ApiResponse
    {
        return new ApiResponse($this->randomApiManager->getData());
    }
}
