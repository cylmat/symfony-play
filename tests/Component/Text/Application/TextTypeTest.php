<?php

namespace App\Test\Text\Application;

use App\Text\Application\TextType;
use PHPUnit\Framework\TestCase;

final class TextTypeTest extends TestCase
{
    private TextType $textType;

    protected function setUp(): void
    {
        $this->textType = new TextType();
    }

    public function testBuildForm(): void
    {
        $this->markTestIncomplete();
    }

    public function testConfigureOptions(): void
    {
        $this->markTestIncomplete();
    }
}
