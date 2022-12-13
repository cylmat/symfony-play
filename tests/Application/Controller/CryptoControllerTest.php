<?php

namespace App\Application\Controller;

use App\Application\Controller\CryptoController;
use App\ControllerTestCase;
use App\Domain\Manager\EncryptManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CryptoControllerTest extends ControllerTestCase
{
    private CryptoController $cryptoController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cryptoController = new CryptoController($this->container);
        $this->cryptoController->setContainer($this->container);
    }

    public function testIndex(): void
    {
        $request = $this->createMock(Request::class);
        $encryptManager = $this->createMock(EncryptManager::class);

        $this->twig
            ->method('render')
            ->with('crypto/index.html.twig')
            ->willReturn('<body>encryptpage</body>');

        $res = $this->cryptoController->index($request, $encryptManager);
        $this->assertEquals(new Response('<body>encryptpage</body>'), $res);
    }
}
