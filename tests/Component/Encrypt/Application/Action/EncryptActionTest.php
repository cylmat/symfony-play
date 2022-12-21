<?php

namespace App\Tests\Component\Encrypt\Application\Action;

use App\Component\Encrypt\Application\Action\EncryptAction;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EncryptActionTest extends WebTestCase
{
    private EncryptAction $encryptAction;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->encryptAction = $container->get(EncryptAction::class);
    }

    public function testExecute(): void
    {   
        $res = $this->encryptAction->execute('go', []);
        $this->assertStringStartsWith('$2y$', $res);
    }
}
