<?php

namespace App\AppBundle\Domain\MessageHandler;

use App\AppBundle\Domain\Message\LogMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class MessageHandler
{
    public function __invoke(LogMessage $message)
    {
    }

    // public function handleOtherMessage(<class> $message)
    // {
    // }
}
