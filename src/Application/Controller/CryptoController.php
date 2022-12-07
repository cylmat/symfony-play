<?php

namespace App\Application\Controller;

use App\Application\Form\CryptoType;
use App\Domain\Manager\EncryptManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CryptoController extends AbstractController
{
    /**
     * @see https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
     */
    #[Route("/cry", name:"app_crypto_index")]
    public function index(Request $request, EncryptManager $encryptManager): Response
    {
        $form = $this->createForm(CryptoType::class);
        $form->handleRequest($request);

        $result = null;
        if (Request::METHOD_POST === $request->getMethod()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $value = $form->getData('crypto_ClearDataToConvert')['ClearDataToConvert'];
                $this->addFlash('success', 'Form sended');

                $result = $encryptManager->encryptValue($value);
            }
        }

        return $this->render('crypto/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }
}
