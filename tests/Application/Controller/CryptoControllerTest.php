<?php

namespace App\Application\Controller;

use App\Application\Controller\CryptoController;
use PHPUnit\Framework\TestCase;

final class CryptoControllerTest extends TestCase
{
    private CryptoController $cryptoController;

    protected function setUp(): void
    {
        $this->cryptoController = new CryptoController();
    }

    public function testIndex(): void
    {
        $this->markTestIncomplete();
    }
}
