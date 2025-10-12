<?php

declare(strict_types=1);

namespace App\MainBundle\Repository\Data\Redis;

use App\MainBundle\Service\Data\Redis\RedisClient;

/**
 * Repository pattern for Redis operations
 * Provides abstraction layer for Redis data access
 */
final class RedisRepository
{
    public function __construct(
        private readonly RedisClient $redisClient,
    ) {
    }

    public function find(string $key): mixed
    {
        $data = $this->redisClient->get($key);

        return $data ? unserialize($data) : null;
    }

    public function findAll(string $pattern = '*'): array
    {
        $keys = $this->redisClient->keys($pattern);
        $results = [];

        foreach ($keys as $key) {
            $data = $this->redisClient->get($key);
            if ($data) {
                $results[$key] = unserialize($data);
            }
        }

        return $results;
    }

    public function save(string $key, mixed $data, ?int $ttl = null): bool
    {
        $serializedData = serialize($data);

        if ($ttl) {
            return $this->redisClient->setex($key, $ttl, $serializedData);
        }

        return $this->redisClient->set($key, $serializedData);
    }

    public function delete(string $key): bool
    {
        return (bool) $this->redisClient->del($key);
    }

    public function exists(string $key): bool
    {
        return (bool) $this->redisClient->exists($key);
    }

    public function increment(string $key, int $value = 1): int
    {
        return $this->redisClient->incrby($key, $value);
    }

    public function decrement(string $key, int $value = 1): int
    {
        return $this->redisClient->decrby($key, $value);
    }

    public function expire(string $key, int $seconds): bool
    {
        return (bool) $this->redisClient->expire($key, $seconds);
    }

    public function ttl(string $key): int
    {
        return $this->redisClient->ttl($key);
    }

    public function flush(): bool
    {
        return $this->redisClient->flushall();
    }

    /**
     * Find all keys matching a pattern with pagination
     */
    public function findByPattern(string $pattern, int $offset = 0, int $limit = 100): array
    {
        $keys = $this->redisClient->keys($pattern);
        $paginatedKeys = array_slice($keys, $offset, $limit);
        $results = [];

        foreach ($paginatedKeys as $key) {
            $data = $this->redisClient->get($key);
            if ($data) {
                $results[$key] = unserialize($data);
            }
        }

        return $results;
    }

    /**
     * Save multiple key-value pairs at once
     */
    public function saveMultiple(array $data, ?int $ttl = null): bool
    {
        $pipeline = $this->redisClient->pipeline();

        foreach ($data as $key => $value) {
            $serializedValue = serialize($value);
            if ($ttl) {
                $pipeline->setex($key, $ttl, $serializedValue);
            } else {
                $pipeline->set($key, $serializedValue);
            }
        }

        $results = $pipeline->execute();

        // Check if all operations were successful
        return !in_array(false, $results, true);
    }

    /**
     * Delete multiple keys at once
     */
    public function deleteMultiple(array $keys): int
    {
        return $this->redisClient->del(...$keys);
    }
}
