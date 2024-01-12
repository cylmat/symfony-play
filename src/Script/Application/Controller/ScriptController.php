<?php

declare(strict_types=1);

namespace App\Script\Application\Controller;

use App\AppBundle\Application\Common\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/script', name: 'app_script_index')]
final class ScriptController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('script/index.html.twig', [
            'links' => $this->getLinks(),
        ]);
    }

    private function getLinks(): array
    {
        return [
            'scriptApi' => $this->generateUrl('script_api')
        ];
    }
}
