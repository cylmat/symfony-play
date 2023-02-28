<?php

namespace App\Test\Encrypt\Application\EventSubscriber;

use App\Encrypt\Application\EventSubscriber\WorkflowSubscriber;
use App\Encrypt\Domain\Model\EncryptedData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Workflow\Event\EnteredEvent;
use Symfony\Component\Workflow\Event\TransitionEvent;
use Symfony\Component\Workflow\Marking;

final class WorkflowSubscriberTest extends TestCase
{
    private MockObject $logger;
    private MockObject $manager;
    private MockObject $doctrine;
    private WorkflowSubscriber $workflowListener;

    /**
     * Sample
     * @requires PHP >= 8
     */
    protected function setUp(): void
    {
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->manager = $this->createMock(ObjectManager::class);
        $this->doctrine = $this->createStub(ManagerRegistry::class);
        $this->doctrine
            ->method('getManager')
            ->will($this->returnValue($this->manager));

        $this->workflowListener = new WorkflowSubscriber($this->logger, $this->doctrine);
    }

    public function testGetSubscribedEvents(): void
    {
        $this->assertIsArray($this->workflowListener->getSubscribedEvents());
    }

    public function testEntered(): void
    {
        $this->logger
            ->expects($this->once())
            ->method('debug')
            ->with($this->stringStartsWith(EncryptedData::class.' entered'));

        $this->manager
            ->expects($this->once())
            ->method('persist');
        $this->manager
            ->expects($this->once())
            ->method('flush');

        $event = new EnteredEvent(new EncryptedData(''), new Marking());
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
