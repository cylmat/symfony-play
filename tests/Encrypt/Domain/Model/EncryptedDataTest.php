<?php

namespace App\Tests\Encrypt\Domain\Model;

use App\Encrypt\Domain\Model\EncryptedData;
use PHPUnit\Framework\TestCase;

final class EncryptedDataTest extends TestCase
{
    private string $value = '42';
    private EncryptedData $encryptedData;

    protected function setUp(): void
    {
        $this->encryptedData = new EncryptedData($this->value);
    }

    public function testGetValue(): void
    {
        $this->assertSame($this->value, $this->encryptedData->getValue());
    }
}
