<?php

namespace App\Test\Encrypt\Application\Listener;

use App\Encrypt\Application\Listener\WorkflowListener;
use PHPUnit\Framework\TestCase;

final class WorkflowListenerTest extends TestCase
{
    private WorkflowListener $workflowListener;

    protected function setUp(): void
    {
        $this->workflowListener = new WorkflowListener();
    }

    public function testGetSubscribedEvents(): void
    {
        $this->markTestIncomplete();
    }

    public function testEntered(): void
    {
        $this->markTestIncomplete();
    }

    public function testTransition(): void
    {
        $this->markTestIncomplete();
    }
}
