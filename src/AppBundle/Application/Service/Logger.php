<?php

namespace App\AppBundle\Application\Service;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Domain\Manager\AppDoctrine;
use DateTimeImmutable;
use Monolog\Level;
use Monolog\Logger as MonologLogger;

/* @phpstan-ignore-next-line: extends @final class Monolog\Logger */
final class Logger extends MonologLogger implements LoggerInterface
{
    public string $channel = 'default';
    protected array $handlers = []; // avoid "reset" errors in tests
    protected array $processors = []; // avoid "reset" errors in tests

    public function __construct(
        private readonly AppDoctrine $appDoctrine
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

        $this->appDoctrine->persist($log, true);

        return true;
    }
}
