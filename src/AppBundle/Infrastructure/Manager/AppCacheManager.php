<?php

namespace App\AppBundle\Infrastructure\Manager;

use App\AppBundle\Domain\CacheInterface;
use Psr\Cache\CacheItemInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\CacheInterface as SymfonyCacheInterface;

final class AppCacheManager implements CacheInterface
{
    /** @param AdapterInterface $symfonyCache */
    public function __construct(
        private readonly SymfonyCacheInterface $symfonyCache,
    ) {
    }

    public function get(string $key, mixed $callbackOrDefaultValue, float $beta = null, array &$metadata = null): mixed
    {
        $callback = $callbackOrDefaultValue;
        if (!\is_callable($callbackOrDefaultValue)) {
            $callback = fn (CacheItemInterface $item) => $callbackOrDefaultValue;
        }

        return $this->symfonyCache->get($key, $callback, $beta, $metadata);
    }

    public function delete(string $key): bool
    {
        return $this->symfonyCache->delete($key);
    }

    // Adapter

    public function setItem(string $key, mixed $value, int $expires = null): void
    {
        $res = $this->symfonyCache->getItem($key);
        if (!$res->isHit()) {
            $res->set($value);
            if ($expires) {
                $res->expiresAfter($expires);
            }
            $this->symfonyCache->save($res);
        }
    }
}
