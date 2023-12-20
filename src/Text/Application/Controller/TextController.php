<?php

namespace App\Text\Application\Controller;

use App\AppBundle\Application\Common\AbstractController;
use App\AppBundle\Application\Common\AppRequest;
use App\Text\Application\TextAction;
use App\Text\Application\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/text', name: 'app_text_index')]
class TextController extends AbstractController
{
    public function __invoke(Request $request, TextAction $textAction): Response
    {
        $textForm = $this->createForm(TextType::class, null, []);
        $textForm->handleRequest($request);

        $response = null;
        /* @todo use Model */
        if ($textForm->isSubmitted() && $textForm->isValid()) {
            $response = $textAction->execute((new AppRequest)
                ->setText($textForm->get('text')->getData())
                ->setCommands([
                    $this->commandArguments(
                        'sed',
                        [
                            'pattern' => $textForm->get('pattern')->getData(),
                            'replace' => $textForm->get('replace')->getData(),
                        ]
                    ),
                ]),
            );
        }

        /** @var TextModel $data */
        $data = $response?->getObjectData();

        return $this->render('text/index.html.twig', [
            'form' => $textForm,
            'result' => $data ? $data->text : null,
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
