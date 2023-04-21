<?php

namespace App\Tests\Text\Application;

use App\AppBundle\Common\AppRequest;
use App\Text\Application\TextAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @groups integration */
final class TextActionTest extends KernelTestCase
{
    private TextAction $textAction;

    protected function setUp(): void
    {
        $this->textAction = static::getContainer()->get(TextAction::class);
    }

    public function testExecute(): void
    {  
        $request = new AppRequest([
            'text' => 'alpha-beta',
            'commands' => [
                [
                    'cmd' => 'sed',
                    'arguments' => [
                        'pattern' => 'alpha',
                        'replace' => 'gamma',
                    ],
                ]
            ],
        ]);
        $res = $this->textAction->execute($request);

        $this->assertSame('gamma-beta', $res);
    }
}
