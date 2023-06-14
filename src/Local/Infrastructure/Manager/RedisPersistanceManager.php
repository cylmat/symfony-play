<?php

namespace App\Local\Infrastructure\Manager;

use App\AppBundle\Infrastructure\Repository\NoDoctrineEntityManagerInterface;
use App\Local\Domain\RedisClientInterface;
use Doctrine\ORM\Mapping as ORM;
use ReflectionAttribute;
use ReflectionClass;

class RedisPersistanceManager implements NoDoctrineEntityManagerInterface
{
    public function __construct(
        private readonly RedisClientInterface $redisClient
    ) {
    }

    public function persist(object $object): void
    {
        $attributes = (new ReflectionClass($object))->getAttributes();
        $tableName = \current(\array_filter($attributes, function (ReflectionAttribute $attribute) {
            return $attribute->getName() === ORM\Table::class;
        }))->getArguments()['name'];

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
