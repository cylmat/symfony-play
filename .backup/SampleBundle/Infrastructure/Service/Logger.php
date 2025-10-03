<?php

namespace App\SampleBundle\Infrastructure\Service;

use App\SampleBundle\Domain\Entity\Log;
use App\SampleBundle\Domain\Service\LoggerInterface;
use App\AppData\Infrastructure\Manager\AppEntityManager;
use DateTimeImmutable;
use Monolog\Level;
use Monolog\Logger as MonologLogger;

final class Logger extends MonologLogger implements LoggerInterface
{
    public string $channel = 'default';
    protected array $handlers = []; // avoid "reset" errors in tests
    protected array $processors = []; // avoid "reset" errors in tests

    public function __construct(
        private readonly AppEntityManager $appDoctrine
    ) {
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function addRecord(string|int|Level $level, string $message, array $context = [], DateTimeImmutable $datetime = null): bool
    {
        $level =
            $level instanceof Level ? $level->getName() :
            (\is_int($level) ? Level::fromValue($level)->getName() : $level);

        $level = \strtolower($level);

        $log = (new Log()) // @todo use factory
            ->setChannel($this->channel)
            ->setLevel($level)
            ->setMessage($message)
        ;

        $this->appDoctrine->save($log);

        return true;
    }
}
