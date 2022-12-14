<?php

namespace App\Application\Controller;

use App\Application\Controller\EncryptController;
use App\ControllerTestCase;
use App\Domain\Manager\EncryptManager;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 * @todo
 */
final class EncryptControllerTest extends ControllerTestCase
{
    private EncryptController $cryptoController;
    private EncryptManager $encryptManager;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cryptoController = new EncryptController($this->container);
        $this->cryptoController->setContainer($this->container);

        $this->cryptoController->index(
            $this->request = $this->createMock(Request::class),
            $this->encryptManager = $this->createMock(EncryptManager::class)
        );
    }

    public function testIndexGet(): void
    {
        // Arrange
        $this->request->method('getMethod')->willReturn('GET');
        $this->encryptManager->expects($this->never())->method('encryptValue');

        $this->form->expects($this->once())->method('handleRequest')->with($this->request);
        $this->form->expects($this->once())->method('createView')->willReturn($formView = new FormView());
        $this->formFactory->method('create')->with(CryptoType::class, null, [])->willReturn($this->form);

        $this->twig
            ->method('render')
            ->with('crypto/index.html.twig', ['form' => $formView, 'result' => null])
            ->willReturn('<body>encryptpage</body>');

        // Act, Assert
        $res = $this->cryptoController->index($this->request, $this->encryptManager);
        $this->assertEquals(new Response('<body>encryptpage</body>'), $res);
    }
}
