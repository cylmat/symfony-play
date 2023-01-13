<?php

namespace App\Tests\Text\Domain\Service;

use App\Text\Domain\Service\SedProcess;
use PHPUnit\Framework\TestCase;

final class SedProcessTest extends TestCase
{
    public function setUp(): void
    {
        $this->sedProcess = new SedProcess();
    }

    public function testProcess(): void
    {
        $expect = 'This is a standard text';
        $this->assertSame($expect, $this->sedProcess->processText(
            'this is a standard test',
            [
                'this' => 'This',
                'test' => 'text',
            ]
        ));
    }
}
