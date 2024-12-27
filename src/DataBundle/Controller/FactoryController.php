<?php

declare(strict_types=1);

namespace App\DataBundle\Controller;

use App\Common\SerializerTrait;
use App\DataBundle\Entity\Factory;
use App\DataBundle\Manager\FactoryManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class FactoryController extends AbstractController
{
    use SerializerTrait;

    public function __construct(
        private readonly FactoryManager $factoryManager,
    ) { }

    #[Route('/data')]
    public function index(): Response
    {
        return $this->render('data/index.html.twig');
    }

    // API

    #[Route('/api/factoryAll', methods: ['GET'])]
    public function getFactories(): JsonResponse
    {
        $data = [
            'factories' => [
                'test',
                'deux'
            ]
        ];
                
        return $this->json([
            'factories' => $data['factories'] 
        ]);
    }

    #[Route('/api/factory', methods: ['POST'])]
    public function postFactory(Request $request): JsonResponse
    {
        $factory = $this->deserialize(
            $request->request->all(),
            Factory::class
        );

        $this->factoryManager->addFactory($factory);
                
        return $this->json(null, 201);
    }
}
