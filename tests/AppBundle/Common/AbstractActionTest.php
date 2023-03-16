<?php

namespace App\Test\AppBundle\Common;

use App\AppBundle\Common\AbstractAction;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractActionTest.
 *
 * @covers \App\AppBundle\Common\AbstractAction
 */
final class AbstractActionTest extends TestCase
{
    private AbstractAction $abstractAction;

    protected function setUp(): void
    {
        $this->abstractAction = $this->getMockBuilder(AbstractAction::class)
            ->setConstructorArgs([])
            ->getMockForAbstractClass();
    }

    public function testExecute(): void
    {
        $this->markTestIncomplete();
    }

    public function testExecuteRequest(): void
    {
        $this->markTestIncomplete();
    }
}
