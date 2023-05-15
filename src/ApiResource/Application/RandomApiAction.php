<?php

namespace App\ApiResource\Application;

use App\AppBundle\Application\Common\ActionInterface;
use App\AppBundle\Application\Common\AppRequest;

class RandomApiAction implements ActionInterface
{
    /** @infection-ignore-all IncrementInteger */
    public function execute(AppRequest $request): mixed
    {
        $data = [
            'type' => 'api',
            'format' => 'json',
            'data' => [
                'random_int' => random_int(1, 9),
                // @todo add redis lua random int
            ],
        ];

        return $data;
    }
}
