<?php

namespace App\Tests\Text\Application;

use App\AppBundle\Application\Common\AppRequest;
use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Infrastructure\MessageHandler\MessageHandler;
use App\Local\Infrastructure\RedisClientInterface;
use App\Local\Infrastructure\RedisRepository;  /** @todo use model redis repository interface */
use App\Text\Application\TextAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\Transport\TransportInterface;

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

    private function getRequest(): AppRequest
    {
        return new AppRequest([
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
    }

    public function testExecute(): void
    {  
        // @todo use workflow

        $res = $this->textAction->execute($this->getRequest());
        $this->assertSame('gamma-beta', $res);

        $this->assertRepository(0);
        $this->assertMessage();
        $this->handleLogMessage();
        $this->assertRepository(1);
    }

    private function assertMessage(): void
    {
        /** @var TransportInterface $transport */
        $transport = static::getContainer()->get('messenger.transport.async_memory');
        $this->assertCount(1, $transport->get());
    }

    private function handleLogMessage(): void
    {
        /** @var TransportInterface $transport */
        $transport = static::getContainer()->get('messenger.transport.async_memory');
        $logMessage = $transport->get()[0]->getMessage();

        // Async
        static::getContainer()->get(MessageHandler::class)->handleLog($logMessage);
    }

    private function assertRepository(int $count): void
    {
        $redisRepository = static::getContainer()->get(RedisRepository::class);
        $this->assertCount($count, $redisRepository->initialize(Log::class)->findAll());
    }
}
