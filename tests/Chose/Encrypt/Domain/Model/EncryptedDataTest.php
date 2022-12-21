<?php

namespace App\Tests\Encrypt\Domain\Model;

use App\Encrypt\Domain\Model\EncryptedData;
use PHPUnit\Framework\TestCase;

final class EncryptedDataTest extends TestCase
{
    private EncryptedData $encryptedData;
    private string $value;

    protected function setUp(): void
    {
        $this->value = '42';
        $this->encryptedData = new EncryptedData($this->value);
    }

    public function testGetValue(): void
    {
        $this->assertSame('42', $this->encryptedData->getValue());
    }
}
