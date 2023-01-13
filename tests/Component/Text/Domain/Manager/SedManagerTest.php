<?php

namespace App\Tests\Text\Domain\Manager;

use App\Text\Domain\Manager\SedManager;
use App\Text\Domain\Service\SedProcess;
use PHPUnit\Framework\TestCase;

final class SedManagerTest extends TestCase
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
