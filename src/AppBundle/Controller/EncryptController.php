<?php

namespace App\AppBundle\Controller;

use App\AppBundle\Common\AppRequest;
use App\Encrypt\Application\EncryptAction;
use App\Encrypt\Application\Form\CryptoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EncryptController extends AbstractController
{
    /** @see https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html */
    #[Route('/encrypt', name: 'app_encrypt_encrypt')]
    public function encrypt(Request $request, EncryptAction $action): Response
    {
        $form = $this->createForm(CryptoType::class);
        $form->handleRequest($request);

        $result = null;
        if (Request::METHOD_POST === $request->getMethod()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $value = $form->getData()['ClearDataToConvert'];
                $this->addFlash('success', 'Form sended');

                $result = $action->execute(
                    new AppRequest(['value' => $value, 'options' => []])
                );
            }
        }

        return $this->render('encrypt/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }
}
