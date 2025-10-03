<?php

declare(strict_types=1);

namespace App\MainBundle\Manager\Data;

use App\AppData\Domain\Contracts\AppCacheInterface;
use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface as SymfonyCacheInterface;

/**
 * Proxy between Symfony cache manager and App cache manager.
 *   - Implements "get" and "set" in simpler way.
 */
final class AppCacheManager implements AppCacheInterface
{
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

    public function set(string $key, mixed $value, int $expires = null): void
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
