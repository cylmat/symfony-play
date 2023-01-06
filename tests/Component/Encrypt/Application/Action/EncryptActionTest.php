<?php

namespace App\Tests\Encrypt\Application\Action;

use App\Encrypt\Application\Action\EncryptAction;
use App\Encrypt\Domain\Manager\EncryptManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @group integration
 */
final class EncryptActionTest extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

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
