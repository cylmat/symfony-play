<?php

namespace App\MainBundle\Controller\Text;

use App\MainBundle\Form\Text\TextType;
use App\MainBundle\Manager\Text\CommandManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/text', name: 'app_text_index')]
class TextController extends AbstractController
{
    public function __construct(
        private readonly CommandManager $cmdManager,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $textForm = $this->createForm(TextType::class, null, []);
        $textForm->handleRequest($request);


        return $this->render('text/index.html.twig', [
            'form' => $textForm,
            'result' => 'ok',
        ]);
    }

    /**
     * @param mixed[][] $arguments
     *
     * @return mixed[]
     */
    private function commandArguments(string $command, array $arguments): array
    {
        return [
            'cmd' => $command,
            'arguments' => $arguments,
        ];
    }
}
