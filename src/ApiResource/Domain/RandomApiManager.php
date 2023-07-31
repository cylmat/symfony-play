<?php

namespace App\ApiResource\Domain;

use App\ApiResource\Domain\Model\RandomApi;
use App\AppBundle\Domain\CacheInterface;
use App\Local\Domain\Manager\RedisManagerInterface;

final class RandomApiManager
{
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly RedisManagerInterface $redisManager,
    ) {
    }

    public function getData(): RandomApi
    {
        $item = $this->cache->get('cache.get', 'cache_get_'.\random_int(0, 10));
        $this->cache->setItem('cache.dynamic', 'cache_dynamic_'.\random_int(0, 10), 8);

        $randomApi = new RandomApi();
        $randomApi->random_int = \random_int(1, 99);
        $randomApi->random_redis = $this->redisManager->getLuaRandomInt();
        $randomApi->cache_get = $item;
        $randomApi->cache_dynamic = $this->cache->get('cache.dynamic', fn () => 'nope');

        return $randomApi;
    }
}
