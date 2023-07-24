<?php

namespace App\ApiResource\Application;

use App\ApiResource\Application\DTO\RandomApiResponseFactory;
use App\ApiResource\Domain\RandomApiManager;
use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Application\OutputInterface;

final class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RandomApiManager $randomApiManager,
        private readonly RandomApiResponseFactory $randomFactory,
        private readonly OutputInterface $output,
    ) {
    }

    public function execute(AppRequest $request): array
    {
        $data = ($this->randomFactory)($this->randomApiManager->getData());

        return $this->output->format($data);
    }
}
