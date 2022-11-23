<?php

namespace App\Controller;

use App\Form\CryptoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CryptoController extends AbstractController
{
    /**
     * @Route("/cry", name="app_crypto_index")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(CryptoType::class);
        $form->handleRequest($request);

        if (Request::METHOD_POST === $request->getMethod()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $this->addFlash('success', 'Form sended');
            }
        }

        return $this->render('crypto/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
