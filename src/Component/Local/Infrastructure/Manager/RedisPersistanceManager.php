<?php

namespace App\Local\Infrastructure\Manager;

use App\AppBundle\Domain\RedisClientInterface;
use ReflectionAttribute;
use ReflectionClass;

class RedisPersistanceManager
{
    public function __construct(
        private readonly RedisClientInterface $redisClient
    ) {
    }

    public function persist($object=null)
    {
        $a = (new ReflectionClass($object))->getAttributes();
        $t = \current(\array_filter($a, function(ReflectionAttribute $v) {
            return $v->getName() === 'Doctrine\ORM\Mapping\Table';
        }));
        $tableName = $t->getArguments()['name'];
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
