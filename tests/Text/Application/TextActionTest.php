<?php

namespace App\Tests\Text\Application;

use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Domain\Entity\Log;
use App\Local\Domain\RedisClientInterface;
use App\Local\Infrastructure\RedisRepository;
use App\Text\Application\TextAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @group integration */
final class TextActionTest extends KernelTestCase
{
    private TextAction $textAction;

    public static function setUpBeforeClass(): void
    {
        static::getContainer()->get(RedisClientInterface::class)->flushall();
    }

    protected function setUp(): void
    {
        $this->textAction = static::getContainer()->get(TextAction::class);
    }

    public function testExecute(): void
    {  
        $request = new AppRequest([
            'text' => 'alpha-beta',
            'commands' => [
                [
                    'cmd' => 'sed',
                    'arguments' => [
                        'pattern' => 'alpha',
                        'replace' => 'gamma',
                    ],
                ]
            ],
        ]);
        $res = $this->textAction->execute($request);

        $this->assertSame('gamma-beta', $res);
    }

    /** @depends testExecute */
    public function testRedisAfterExecute(): void
    {
        /** @var RedisRepository $redisRepository */
        $redisRepository = static::getContainer()->get(RedisRepository::class);
        $this->assertSame(1, \count($redisRepository->initialize(Log::class)->findAll()));
    }
}
