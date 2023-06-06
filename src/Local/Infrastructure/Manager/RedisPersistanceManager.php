<?php

namespace App\Local\Infrastructure\Manager;

use App\Local\Domain\Entity\RedisLog;
use App\Local\Domain\RedisClientInterface;
use ReflectionAttribute;
use ReflectionClass;

class RedisPersistanceManager implements PersistanceManagerInterface
{
    public function __construct(
        private readonly RedisClientInterface $redisClient
    ) {
    }

    public function persist(RedisLog $object = null)
    {
        $attributes = (new ReflectionClass($object))->getAttributes();
        $table = \current(\array_filter($attributes, function (ReflectionAttribute $attribute) {
            return $attribute->getName() === 'Doctrine\ORM\Mapping\Table';
        }));

        $tableName = $table->getArguments()['name'];
        $this->redisClient->set(
            $tableName.':'.uniqId(),
            \serialize($object)
        );
    }

    public function flushall()
    {
        $this->redisClient->flushall();
    }
}
