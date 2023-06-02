<?php

namespace App\Tests\Encrypt\Domain\Service\Encryption;

use App\Encrypt\Domain\Exception\AlgorithmNotFoundException;
use App\Encrypt\Domain\Service\Encryption\BcryptEncryption;
use App\Encrypt\Domain\Service\Encryption\EncryptionFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Workflow\WorkflowInterface;

final class EncryptionFactoryTest extends TestCase
{
    private WorkflowInterface $encryptWorkflow;
    private EncryptionFactory $encryptionFactory;

    protected function setUp(): void
    {
        $this->encryptWorkflow = $this->createMock(WorkflowInterface::class);
        $this->encryptionFactory = new EncryptionFactory($this->encryptWorkflow);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(BcryptEncryption::class, $this->encryptionFactory->create('bcrypt'));
    }

    /** @expectException AlgorithmNotFoundException */
    public function testCreateFail(): void
    {
        $this->expectException(AlgorithmNotFoundException::class);
        $this->encryptionFactory->create('not');
    }
}
