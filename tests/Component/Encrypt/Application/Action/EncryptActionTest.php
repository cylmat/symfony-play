<?php

namespace App\Tests\Encrypt\Application\Action;

use App\Encrypt\Application\Action\EncryptAction;
use App\Encrypt\Domain\Manager\EncryptManager;
use PHPUnit\Framework\TestCase;

final class EncryptActionTest extends TestCase
{
    protected function setUp(): void
    {
        $this->encryptManager = $this->createMock(EncryptManager::class);
        $this->encryptAction = new EncryptAction($this->encryptManager);
    }

    public function testExecute(): void
    {   
        $this->encryptManager
            ->method('encryptValue')
            ->with('bcrypt', 'value', ['option'])
            ->willReturn('$2y$');

        $res = $this->encryptAction->execute('value', ['option']);
        $this->assertSame('$2y$', $res);
    }
}
