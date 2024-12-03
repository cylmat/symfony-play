<?php

declare(strict_types=1);

namespace App\DataBundle\Repository\Redis;

use App\AppData\Infrastructure\AppRepositoryInterface;
use App\AppData\Infrastructure\Manager\AppEntityManager;

final class RedisRepository implements AppRepositoryInterface
{
    private string $entityName;

    public function __construct(
        private readonly RedisClient $redisClient,
        private readonly AppEntityManager $appRegistry,
    ) {
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function flushAll(): void
    {
        // to implements ...
    }

    public function truncate(): void
    {
        // ...
    }
}
