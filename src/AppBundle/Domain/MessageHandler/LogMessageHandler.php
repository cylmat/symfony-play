<?php

namespace App\AppBundle\Domain\MessageHandler;

use App\AppBundle\Domain\Message\LogMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class LogMessageHandler
{
    public function __invoke(LogMessage $message)
    {
    }
}
