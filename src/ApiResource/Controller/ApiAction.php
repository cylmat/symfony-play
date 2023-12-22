<?php

declare(strict_types=1);

namespace App\ApiResource\Controller;

use App\AppBundle\Application\Common\AppRequest;
use App\Data\Application\RandomApiAction;
use Symfony\Component\Routing\RouterInterface;

final class ApiAction
{
    public function __construct(
        private readonly RouterInterface $router,
        private readonly RandomApiAction $randomApiAction,
    ) {      
    }

    public function execute(): array
    {
        return [
            'data' => [
                'id' => '0',
                'type' => 'api',
                'randomApi' => $this->randomApiAction->execute(new AppRequest()),
            ],
            'relationships' => [
                'links' => [
                ],
            ],
        ];
    }
}
