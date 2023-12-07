<?php

declare(strict_types=1);

namespace App\ApiResource\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Application\OutputInterface;
use App\Data\Application\DTO\RandomApiResponseNormalizer;
use App\Data\Domain\Manager\RandomApiManager;

final class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RandomApiManager $randomApiManager,
        private readonly RandomApiResponseNormalizer $randomFactory,
        private readonly OutputInterface $output,
    ) {
    }

    public function execute(AppRequest $request): array
    {
        $data = ($this->randomFactory)($this->randomApiManager->getData());

        return $this->output->format($data);
    }
}
