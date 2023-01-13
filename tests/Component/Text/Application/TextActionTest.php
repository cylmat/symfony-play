<?php

namespace App\Tests\Encrypt\Application;

use App\AppBundle\Common\AppRequest;
use App\Text\Application\TextAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @group integration
 */
final class TextActionTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $this->textAction = static::getContainer()->get(TextAction::class);
    }

    public function testExecute(): void
    {  
        $request = new AppRequest(['text' => 'alpha-beta', 'arguments' => ['alpha' => 'gamma']]);
        $res = $this->textAction->execute($request);
        $this->assertSame('gamma-beta', $res);
    }
}
