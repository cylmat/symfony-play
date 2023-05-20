<?php

namespace App\AppBundle\Infrastructure\Dbal;

use Doctrine\DBAL\Connection;

class ConnectionWrapper extends Connection
{
    public function connect(): bool
    {
        return parent::connect();
    }
}
