<?php

declare(strict_types=1);

namespace App\AppData\Domain\Manager;

use App\AppBundle\Domain\CacheInterface;
use App\AppBundle\Domain\DomainManagerInterface;
use App\AppData\Domain\Model\RandomApi;
use App\AppData\Domain\Service\CustomScriptsInterface;

final class RandomApiManager implements DomainManagerInterface
{
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly CustomScriptsInterface $scriptManager,
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
