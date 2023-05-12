<?php

namespace App\Tests\Encrypt\Application;

use App\AppBundle\Common\AppRequest;
use App\Encrypt\Application\EncryptAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/** @group integration */
final class EncryptActionTest extends KernelTestCase
{
    private EncryptAction $encryptAction;

    protected function setUp(): void
    {
        $this->encryptAction = static::getContainer()->get(EncryptAction::class);
    }

    public function testExecute(): void
    {
        $request = new AppRequest(['value' => 'value', 'options' => ['options']]);
        $res = $this->encryptAction->execute($request);
        $this->assertStringStartsWith('$2y$', $res);
    }
}
