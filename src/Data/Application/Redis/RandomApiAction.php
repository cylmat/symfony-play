<?php

declare(strict_types=1);

namespace App\Data\Application\Redis;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\Data\Domain\Redis\RandomApiManager;

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
