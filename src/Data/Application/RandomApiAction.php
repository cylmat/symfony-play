<?php

declare(strict_types=1);

namespace App\Data\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\Data\Domain\Manager\RandomApiManager;

final class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RandomApiManager $randomApiManager,
    ) {
    }

    public function execute(AppRequest $request): RandomApiResponse
    {
        return new RandomApiResponse($this->randomApiManager->getData());
    }
}
