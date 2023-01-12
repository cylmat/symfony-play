<?php

namespace App\Tests\Text\Domain\Manager;

use App\Component\Text\Domain\Manager\SedManager;
use App\Text\Domain\Service\SedProcess;
use PHPUnit\Framework\TestCase;

class SedManagerTest extends TestCase
{
    public function setUp(): void
    {
        $this->sedManager = new SedManager(new SedProcess());
    }

    public function testSomething(): void
    {
        $this->assertSame(
            'alpha-beta',
            $this->sedManager->substituteText(
                'gamma-delta',
                ['gamma' => 'alpha', 'delta' => 'beta']
            )
        );
    }
}
