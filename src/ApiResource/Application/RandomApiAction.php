<?php

declare(strict_types=1);

namespace App\ApiResource\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\Data\Application\DTO\RandomApi;
use App\Data\Domain\Manager\RandomApiManager;

final class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RandomApiManager $randomApiManager,
    ) {
    }

    public function execute(AppRequest $request): RandomApi
    {
        return $this->randomApiManager->getData();
    }
}
