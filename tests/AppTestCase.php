<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

abstract class AppTestCase extends TestCase
{
    protected Logger|MockObject $mockedLogger;

    protected function setUp(): void
    {
        $this->mockedLogger = $this->createMock(Logger::class);
    }
}
