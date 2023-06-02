<?php

namespace App\Tests\Encrypt\Domain\Service\Encryption;

use App\Encrypt\Domain\Service\Encryption\HashAlgorithm;
use PHPUnit\Framework\TestCase;

final class HashAlgorithmTest extends TestCase
{
    public function testCases(): void
    {
        $this->assertSame('BCRYPT', HashAlgorithm::BCRYPT);
    }
}
