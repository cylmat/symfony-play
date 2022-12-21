<?php

namespace App\Tests\Component\Encrypt\Domain\Service\Encryption;

use App\Component\Encrypt\Domain\Service\Encryption\HashAlgorithm;
use PHPUnit\Framework\TestCase;

final class HashAlgorithmTest extends TestCase
{
    public function testCases(): void
    {
        $this->assertSame('BCRYPT', HashAlgorithm::BCRYPT);
    }
}
