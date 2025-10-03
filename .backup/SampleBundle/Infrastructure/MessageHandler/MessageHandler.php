<?php

namespace App\SampleBundle\Infrastructure\MessageHandler;

use App\SampleBundle\Domain\Message\LogMessage;
use App\SampleBundle\Domain\Service\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class MessageHandler
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    #[AsMessageHandler()]
    public function handleLog(LogMessage $log)
    {
        $this->logger->setChannel($log->channel)->info($log->logmessage);
    }
}
