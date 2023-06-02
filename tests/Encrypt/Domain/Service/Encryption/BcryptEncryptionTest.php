<?php

namespace App\Tests\Encrypt\Domain\Service\Encryption;

use App\Encrypt\Domain\Model\EncryptedData;
use App\Encrypt\Domain\Service\Encryption\BcryptEncryption;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Workflow\WorkflowInterface;

final class BcryptEncryptionTest extends TestCase
{
    private WorkflowInterface $encryptWorkflow;
    private BcryptEncryption $bcryptEncryption;

    protected function setUp(): void
    {
        $this->encryptWorkflow = $this->createMock(WorkflowInterface::class);
        $this->bcryptEncryption = new BcryptEncryption($this->encryptWorkflow);
    }

    public function testEncrypt(): void
    {
        $this->encryptWorkflow
            ->expects($this->once())
            ->method('apply')
            ->with($this->isInstanceOf(EncryptedData::class), EncryptedData::PROCESS_TRANSITION);

        $this->assertInstanceOf(EncryptedData::class, $this->bcryptEncryption->encrypt('value', []));
    }
}
