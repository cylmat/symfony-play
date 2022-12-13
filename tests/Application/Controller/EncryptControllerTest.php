<?php

namespace App\Application\Controller;

use App\Application\Controller\EncryptController;
use App\Application\Form\CryptoType;
use App\ControllerTestCase;
use App\Domain\Manager\EncryptManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function testIndexPost(): void
    {
        // Arrange
        $this->request->method('getMethod')->willReturn('POST');

        $this->form->expects($this->once())->method('handleRequest')->with($this->request);
        $this->form->method('isSubmitted')->willReturn(true);
        $this->form->method('isValid')->willReturn(true);
        $this->form->expects($this->once())->method('createView')->willReturn($formView = new FormView());
        $this->form
            ->method('getData')
            ->with('crypto_ClearDataToConvert')
            ->willReturn(['ClearDataToConvert' => 'mydata'])
        ;

        $this->formFactory->method('create')->with(CryptoType::class, null, [])->willReturn($this->form);
        $this->flashBag->expects($this->once())->method('add')->with('success', 'Form sended');
        $this->encryptManager->method('encryptValue')->with('bcrypt', 'mydata')->willReturn('$2y.encryptedData');

        $this->twig
            ->method('render')
            ->with('crypto/index.html.twig', ['form' => $formView, 'result' => '$2y.encryptedData'])
            ->willReturn('<body>encryptpage</body>');

        // Act, Assert 
        $res = $this->cryptoController->index($this->request, $this->encryptManager);
        $this->assertEquals(new Response('<body>encryptpage</body>'), $res);
    }
}
