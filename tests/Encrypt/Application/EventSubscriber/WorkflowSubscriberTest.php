<?php

namespace App\Test\Encrypt\Application\EventSubscriber;

use App\AppBundle\Domain\Entity\Log;
use App\AppBundle\Infrastructure\AppDoctrine;
use App\Encrypt\Application\EventSubscriber\WorkflowSubscriber;
use App\Encrypt\Domain\Model\EncryptedData;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Workflow\Event\EnteredEvent;
use Symfony\Component\Workflow\Event\TransitionEvent;
use Symfony\Component\Workflow\Marking;

final class WorkflowSubscriberTest extends TestCase
{
    private LoggerInterface|MockObject $logger;
    private AppDoctrine|MockObject $doctrine;
    private WorkflowSubscriber $workflowListener;

    /**
     * Sample
     * @requires PHP >= 8
     */
    protected function setUp(): void
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->doctrine = $this->createStub(AppDoctrine::class);
        $this->workflowListener = new WorkflowSubscriber($this->logger, $this->doctrine);
    }

    public function testGetSubscribedEvents(): void
    {
        $this->assertArrayHasKey('workflow.encrypt.entered', $this->workflowListener->getSubscribedEvents());
        $this->assertArrayHasKey('workflow.encrypt.transition', $this->workflowListener->getSubscribedEvents());
    }

    public function testEntered(): void
    {
        $this->logger
            ->expects($this->once())
            ->method('debug')
            ->with($this->stringStartsWith(EncryptedData::class.' entered'));

        $this->doctrine
            ->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Log::class), true);

        $event = new EnteredEvent(
            (new EncryptedData(''))->setCurrentPlace(['TESTPLACE' => true]),
            new Marking()
        );
        $this->assertNull($this->workflowListener->entered($event));

        $this->expectException(\RuntimeException::class);
        $event = new EnteredEvent(new \stdClass(), new Marking());
        $this->workflowListener->entered($event);
    }

    public function testTransition(): void
    {
        $event = new TransitionEvent(new EncryptedData(''), new Marking());
        $this->assertNull($this->workflowListener->transition($event));

        $this->expectException(\RuntimeException::class);
        $event = new TransitionEvent(new \stdClass(), new Marking());
        $this->workflowListener->transition($event);
    }
}
