<?php

namespace App\Tests\Integration;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Infrastructure\Repository\LogRepository;
use App\AppData\Infrastructure\Manager\AppEntityRegistry;
use App\AppData\Infrastructure\Redis\RedisRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @group integration */
final class EntityRegistryTest extends KernelTestCase
{
    private AppEntityRegistry $appEntityRegistry;
    private LogRepository     $logRepository;
    private RedisRepository   $redisRepository;

    public function setUp(): void
    {
        $this->appEntityRegistry = static::getContainer()->get(AppEntityRegistry::class);
        // mysql & sqlite
        $this->logRepository = static::getContainer()->get(LogRepository::class);
        // redis
        $this->redisRepository = static::getContainer()->get(RedisRepository::class);

        $this->logRepository->flushall();
        $this->redisRepository->flushall();
    }

    /** Entities */

    public function testEntityManager(): void
    {
        $this->assertInstanceOf(ManagerRegistry::class, $this->appEntityRegistry->getDoctrine());
    }

    public function testDoctrineEntityPersistence(): void
    {
        $entity = (new Log())->setLevel('DEBUG')->setChannel('test')->setMessage('testing');
        
        // empty
        $this->assertEmpty($this->logRepository->findAll());

        // id
        $this->appEntityRegistry->save($entity);
        $id = $entity->getId();

        $this->assertNotNull($id);
        $this->assertTrue($id > 0);

        // persist
        $this->assertNotNull($this->logRepository->find($id));
        $this->assertInstanceOf(Log::class, $this->logRepository->find($id));
        ### @todo $this->assertCount(1, $this->logRepository->findAll());

        // remove
        $this->logRepository->remove($entity);
        ### @todo $this->assertSame(0, $this->logRepository->count([]));
        ### @todo $this->assertEmpty($this->logRepository->findAll());
    }
}
