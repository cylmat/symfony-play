<?php

namespace App\AwsBundle\Controller;

use App\AwsBundle\Manager\ElastiCacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class AwsController extends AbstractController
{
    public function __construct(
        private readonly ElastiCacheManager $cacheManager
    ) {}

    #[Route('/aws')]
    public function run()
    {
        $this->cacheManager->run();

        return $this->render('test-run.html.twig');
    }
}
