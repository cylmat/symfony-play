<?php

namespace App\Tests\Integration;

use App\AppBundle\Application\Common\Api\ApiNormalizerManagerInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\AppData\Domain\Contracts\AppCacheInterface;
use App\AppData\Infrastructure\Redis\RedisRepository;
use App\Data\Application\RandomApiAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @group integration */
final class RandomApiActionTest extends KernelTestCase
{
    private RandomApiAction $randomApiAction;
    private ApiNormalizerManagerInterface $responseNormalizer;

    public static function setUpBeforeClass(): void
    {
        static::getContainer()->get(AppCacheInterface::class)->delete('cache.get');
        static::getContainer()->get(AppCacheInterface::class)->delete('cache.dynamic');
        static::getContainer()->get(RedisRepository::class)->flushall();
    }

    protected function setUp(): void
    {   
        $this->randomApiAction = static::getContainer()->get(RandomApiAction::class);
        $this->responseNormalizer = static::getContainer()->get(ApiNormalizerManagerInterface::class);
    }

    public function testExecute(): void
    {
        $response = $this->randomApiAction->execute(new AppRequest());
        $data = $this->responseNormalizer->normalizeResponse($response);

        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('id', $data['data']);
        $this->assertArrayHasKey('type', $data['data']);
        $this->assertArrayHasKey('random_int', $data['data']['attributes']);
        $this->assertArrayHasKey('random_script_int', $data['data']['attributes']);

        $this->checkCache();
    }

    private function checkCache(): void
    {
        $cache = static::getContainer()->get(AppCacheInterface::class);
        $this->assertStringStartsWith('cache_get_', $cache->get('cache.get', fn() => ''));
        $this->assertStringStartsWith('cache_dynamic_', $cache->get('cache.dynamic', fn() => ''));
    }
}
