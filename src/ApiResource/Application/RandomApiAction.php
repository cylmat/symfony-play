<?php

namespace App\ApiResource\Application;

use App\ApiResource\Domain\RandomApiManager;
use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Application\Contracts\JsonApiFormatterFactoryInterface;
use App\Local\Domain\RedisManager;

final class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RedisManager $redisManager,
        private readonly JsonApiFormatterFactoryInterface $jsonApiFormatterFactory,
        private readonly RandomApiManager $randomManager,
    ) {
    }

    /** @infection-ignore-all IncrementInteger */
    public function execute(AppRequest $request): mixed
    {
        $this->randomManager->run();

        $document = $this->jsonApiFormatterFactory->createDocument('api', \random_int(1, 9));
        $document->add('random_int', \random_int(1, 99));
        $document->add('random_redis', $this->redisManager->getLuaRandomInt());

        return $document->toArray();
    }
}
