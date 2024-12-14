<?php

declare(strict_types=1);

namespace App\SampleBundle\Infrastructure\Dbal;

use Doctrine\DBAL\Connection;

final class ConnectionWrapper extends Connection
{
    public function connect(): bool
    {
        return parent::connect();
    }
}
