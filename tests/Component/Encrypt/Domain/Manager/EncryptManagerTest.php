<?php

namespace App\Tests\Encrypt\Domain\Manager;

use App\Encrypt\Domain\Manager\EncryptManager;
use App\Encrypt\Domain\Model\EncryptedData;
use App\Encrypt\Domain\Service\Encryption\BcryptEncryption;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Workflow\WorkflowInterface;

final class EncryptManagerTest extends TestCase
{
    private WorkflowInterface $encryptWorkflow;
    private EncryptionFactory $encryptFactory;
    private EncryptManager $encryptManager;

    protected function setUp(): void
    {
        $this->encryptWorkflow = $this->createMock(WorkflowInterface::class);
        $this->encryptFactory = $this->createMock(EncryptionFactory::class);
        $this->encryptManager = new EncryptManager($this->encryptFactory, $this->encryptWorkflow);
    }

    public function testEncryptValue(): void
    {
        $bcrypt = $this->createMock(BcryptEncryption::class);
        $bcrypt
            ->method('encrypt')
            ->with('testvalue', [])
            ->willReturn($data = new EncryptedData('$2y$12x'));

        $this->encryptFactory
            ->method('create')
            ->with('bcrypt')
            ->willReturn($bcrypt);

        $this->encryptWorkflow
            ->expects($this->once())
            ->method('apply')
            ->with($this->isInstanceOf(EncryptedData::class), EncryptedData::FINISH_TRANSITION);

        $this->assertSame($data->getValue(), $this->encryptManager->encryptValue('bcrypt', 'testvalue', []));
    }
}
