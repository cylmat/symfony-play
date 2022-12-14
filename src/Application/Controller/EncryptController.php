<?php

namespace App\Application\Controller;

use App\Application\Form\CryptoType;
use App\Domain\Manager\EncryptManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EncryptController extends AbstractController
{
    private const NEEDTOBECHANGED = 'bcrypt';

    /**
     * @see https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
     */
    #[Route('/encrypt', name: 'app_encrypt_index')]
    public function index(Request $request, EncryptManager $encryptManager): Response
    {
        $form = $this->createForm(CryptoType::class);
        $form->handleRequest($request);

        $result = null;
        if (Request::METHOD_POST === $request->getMethod()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $value = $form->getData()['ClearDataToConvert'];
                $this->addFlash('success', 'Form sended');

                $result = $encryptManager->encryptValue(self::NEEDTOBECHANGED, $value, []);
            }
        }

        return $this->render('crypto/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }
}
