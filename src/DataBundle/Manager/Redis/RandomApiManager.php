<?php

declare(strict_types=1);

namespace App\DataBundle\Manager\Redis;


use App\AppData\Domain\Contracts\AppCacheInterface;
use App\Data\Domain\Redis\RandomApi;
use App\Data\Domain\Redis\RedisScriptsInterface;

final class RandomApiManager 
{
    public function __construct(
        private readonly AppCacheInterface $cache,
        private readonly RedisScriptsInterface $scriptManager,
    ) {
    }

    public function getData(): RandomApi
    {
        $item = $this->cache->get('cache.get', 'cache_get_'.\random_int(0, 10));
        $this->cache->set('cache.dynamic', 'cache_dynamic_'.\random_int(0, 10), 8);

        $randomApi = new RandomApi();
        $randomApi->random_int = \random_int(1, 99);
        $randomApi->random_script_int = $this->scriptManager->getRandomInt();
        $randomApi->cache_get = $item;
        $randomApi->cache_dynamic = $this->cache->get('cache.dynamic', fn () => 'nope');

        return $randomApi;
    }
}
