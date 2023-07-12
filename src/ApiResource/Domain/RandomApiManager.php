<?php

namespace App\ApiResource\Domain;

use App\ApiResource\Domain\Model\RandomApi;
use App\Local\Domain\RedisManager;
use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Contracts\Cache\CacheInterface;

final class RandomApiManager
{
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly RedisManager $redisManager,
    ) {
    }

    public function getData(): RandomApi
    {
        /** @var CacheItemInterface $item */
        $item = $this->cache->get('cache.get', fn (CacheItemInterface $item) => 'cache.get.'.\random_int(0, 10));

        /** @var AbstractAdapter $dynamic */
        $dynamic = clone $this->cache;
        $res = $dynamic->getItem('cache.dynamic');
        if (!$res->isHit()) {
            $res->set('cache.dynamic.'.\random_int(0, 10));
            $res->expiresAfter(3);
            $dynamic->save($res);
        }

        $randomApi = new RandomApi();
        $randomApi->random_int = \random_int(1, 99);
        $randomApi->random_redis = $this->redisManager->getLuaRandomInt();
        $randomApi->cache_get = $item;
        $randomApi->cache_dynamic = $res->get();

        return $randomApi;
    }
}
