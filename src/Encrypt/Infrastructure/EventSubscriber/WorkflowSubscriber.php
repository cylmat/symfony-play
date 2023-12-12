<?php

namespace App\Encrypt\Infrastructure\EventSubscriber;

use App\AppBundle\Domain\Entity\Log; /** @todo don't call app entity directly, use log service */
use App\AppData\Infrastructure\Manager\AppEntityRegistry;
use App\Encrypt\Domain\Model\EncryptedData;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use RuntimeException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\EnteredEvent;
use Symfony\Component\Workflow\Event\TransitionEvent;

class WorkflowSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly LoggerInterface $mainLogger,
        private readonly AppEntityRegistry $doctrine
    ) {
    }

    /** @return string[] */
    public static function getSubscribedEvents(): array
    {
        return [
            'workflow.encrypt.entered' => 'entered',
            'workflow.encrypt.transition' => 'transition',
        ];
    }

    /** @SuppressWarnings(PHPMD.MissingImport) */
    public function entered(EnteredEvent $event): void
    {
        $event->getSubject() instanceof EncryptedData or throw new RuntimeException('Event subject must be an instance of '.EncryptedData::class);
        $this->mainLogger->debug(EncryptedData::class.' entered in "'.($place = \array_key_first($event->getSubject()->getCurrentPlace())).'" place.');

        $log = (new Log())
            ->setChannel('workflow')
            ->setLevel(LogLevel::INFO)
            ->setMessage('Encrypted data entered in '.$place);

        $this->doctrine->persist($log, true);
    }

    /** @SuppressWarnings(PHPMD.MissingImport) */
    public function transition(TransitionEvent $event): void
    {
        $event->getSubject() instanceof EncryptedData or throw new RuntimeException('Event subject must be an instance of '.EncryptedData::class);
    }
}
