<?php

namespace App\Test\ApiResource\Application\Controller;

use App\ApiResource\Application\RandomApiAction;
use App\AppBundle\Application\Common\Api\ApiResponseNormalizerManagerInterface;
use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Domain\CacheInterface;
use App\Data\Infrastructure\RedisClientInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @group integration */
final class RandomApiActionTest extends KernelTestCase
{
    private RandomApiAction $randomApiAction;
    private ApiResponseNormalizerManagerInterface $responseNormalizer;

    public static function setUpBeforeClass(): void
    {
        static::getContainer()->get(CacheInterface::class)->delete('cache.get');
        static::getContainer()->get(CacheInterface::class)->delete('cache.dynamic');

        static::getContainer()->get(RedisClientInterface::class)->flushall();
    }

    protected function setUp(): void
    {   
        $this->randomApiAction = static::getContainer()->get(RandomApiAction::class);
        $this->responseNormalizer = static::getContainer()->get(ApiResponseNormalizerManagerInterface::class);
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
        $cache = static::getContainer()->get(CacheInterface::class);
        $this->assertStringStartsWith('cache_get_', $cache->get('cache.get', fn() => ''));
        $this->assertStringStartsWith('cache_dynamic_', $cache->get('cache.dynamic', fn() => ''));
    }
}
