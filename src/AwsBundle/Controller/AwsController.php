<?php

namespace App\AwsBundle\Controller;

use App\AwsBundle\Manager\AwsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class AwsController extends AbstractController
{
    public function __construct(
        private readonly AwsManager $awsManager
    ) {
    }

    #[Route('/aws')]
    public function run()
    {
        $data = $this->awsManager->run();

        return $this->render('aws-run.html.twig', [
            'dynamodb' => $data['dynamodb']
        ]);
    }
}
