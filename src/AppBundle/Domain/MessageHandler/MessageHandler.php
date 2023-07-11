<?php

namespace App\AppBundle\Domain\MessageHandler;

use App\AppBundle\Application\Service\LoggerInterface;
use App\AppBundle\Domain\Message\LogMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class MessageHandler
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    #[AsMessageHandler()]
    public function handleLog(LogMessage $log)
    {
        $this->logger->setChannel($log->channel)->info($log->logmessage);
    }
}
