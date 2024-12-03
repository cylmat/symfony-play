<?php

namespace App\TextBundle\Controller;

use App\TextBundle\Form\TextType;
use App\TextBundle\Manager\CommandManager;
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

        // $response = null;
        // /* @todo use Model */
        // if ($textForm->isSubmitted() && $textForm->isValid()) {
        //     $response = $textAction->execute((new AppRequest)
        //         ->setText($textForm->get('text')->getData())
        //         ->setCommands([
        //             $this->commandArguments(
        //                 'sed',
        //                 [
        //                     'pattern' => $textForm->get('pattern')->getData(),
        //                     'replace' => $textForm->get('replace')->getData(),
        //                 ]
        //             ),
        //         ]),
        //     );
        // }

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
