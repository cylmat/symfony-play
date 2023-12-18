<?php

namespace App\Tests\Integration;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Infrastructure\Repository\LogRepository;
use App\AppData\Infrastructure\Manager\AppEntityRegistry;
use App\AppData\Infrastructure\Manager\AppSupportRegistry;
use App\AppData\Infrastructure\Redis\RedisRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @group integration */
final class EntityRegistryTest extends KernelTestCase
{
    private AppEntityRegistry $appEntityRegistry;
    private LogRepository     $logRepository;
    private RedisRepository   $redisRepository;
    private AppSupportRegistry $appSupportRegistry;

    public function setUp(): void
    {
        $this->appEntityRegistry = static::getContainer()->get(AppEntityRegistry::class);
        $this->appSupportRegistry = static::getContainer()->get(AppSupportRegistry::class);
        // mysql & sqlite
        $this->logRepository = static::getContainer()->get(LogRepository::class);
        // redis
        $this->redisRepository = static::getContainer()->get(RedisRepository::class);
       
        $this->appSupportRegistry->getDefaultDoctrineManager('default')
            ->createQueryBuilder()
            ->delete(Log::class, 'l')
            ->where("1=1")
            ->getQuery()
            ->execute();

        $this->appSupportRegistry->getManager('sqlite')
            ->createQueryBuilder()
            ->delete(Log::class, 'l')
            ->where("1=1")
            ->getQuery()
            ->execute();
        
        $this->appSupportRegistry->getDefaultDoctrineManager('default')
            ->createQuery("DELETE FROM ".Log::class)->execute();

        $this->appSupportRegistry->getManager('sqlite')
            ->createQuery("DELETE FROM ".Log::class)->execute();

        $this->logRepository->flushall();
        $this->redisRepository->flushall();
    
    }

    /** Entities */

    public function testDoctrineEntityPersistence(): void
    {
        $entity = (new Log())->setLevel('DEBUG')->setChannel('test')->setMessage('testing');
        
        // empty
        $this->assertEmpty($this->logRepository->findAll());

        // id
        $this->appEntityRegistry->save($entity);
        $id = $entity->getId();

        // test
        $mysql = $this->appSupportRegistry->getDefaultDoctrineManager('default');
        $sqlite = $this->appSupportRegistry->getManager('sqlite');
        $r = $mysql->getRepository($entity::class)->findAll();
        $d = $sqlite->getRepository($entity::class)->findAll();

        $this->assertNotNull($id);
        $this->assertTrue($id > 0);

        // persist
        $this->assertNotNull($this->logRepository->find($id));
        $this->assertInstanceOf(Log::class, $this->logRepository->find($id));
        $this->assertCount(1, $this->logRepository->findAll());

        // remove
        $this->appEntityRegistry->remove($entity);
        $this->assertSame(0, $this->logRepository->count([]));
        $this->assertEmpty($this->logRepository->findAll());
    }
}
