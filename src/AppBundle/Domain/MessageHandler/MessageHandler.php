<?php

namespace App\AppBundle\Domain\MessageHandler;

use App\AppBundle\Application\Service\LoggerInterface;
use App\AppBundle\Domain\Message\LogMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
readonly class MessageHandler
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    public function __invoke(LogMessage $log)
    {
        $this->logger->setChannel($log->channel)->info($log->logmessage);
    }

    // public function handleOtherMessage(<class> $message)
    // {
    // }
}
