<?php

namespace App\ApiResource\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\Local\Domain\RedisManager;

class RandomApiAction implements ActionInterface
{
    public function __construct(
        private readonly RedisManager $redisManager
    ) {
    }

    /** @infection-ignore-all IncrementInteger */
    public function execute(AppRequest $request): mixed
    {
        $data = [
            'type' => 'api',
            'format' => 'json',
            'data' => [
                'random_int' => \random_int(1, 9),
                'random_redis' => $this->redisManager->getLuaRandomInt(),
            ],
        ];

        return $data;
    }
}
