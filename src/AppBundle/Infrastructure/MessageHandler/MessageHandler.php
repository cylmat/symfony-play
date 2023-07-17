<?php

namespace App\AppBundle\Infrastructure\MessageHandler;

use App\AppBundle\Domain\Message\LogMessage;
use App\AppBundle\Domain\Service\LoggerInterface;
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
