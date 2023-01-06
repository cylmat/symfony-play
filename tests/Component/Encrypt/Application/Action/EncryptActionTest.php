<?php

namespace App\Tests\Encrypt\Application\Action;

use App\Encrypt\Application\Action\EncryptAction;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @group integration
 */
final class EncryptActionTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $this->encryptAction = static::getContainer()->get(EncryptAction::class);
    }

    public function testExecute(): void
    {   
        $res = $this->encryptAction->execute('value', ['option']);
        $this->assertStringStartsWith('$2y$', $res);
    }
}
