<?php

namespace App\ApiResource\Domain;

use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Contracts\Cache\CacheInterface;

final class RandomApiManager
{
    public function __construct(
        private readonly CacheInterface $cache,
    ) {
    }

    public function run(): mixed
    {
        /** @var CacheItemInterface $item */
        $item = $this->cache->get('cache.get', fn (CacheItemInterface $item) => \random_int(0, 10));

        /** @var AbstractAdapter $dynamic */
        $dynamic = clone $this->cache;
        $res = $dynamic->getItem('cache.dynamic');
        if (!$res->isHit()) {
            $res->set(\random_int(0, 10));
            $res->expiresAfter(3);
            $dynamic->save($res);
        }

        return [
            'cache.get' => $item,
            'cache.dynamic' => $res->get(),
        ];
    }
}
