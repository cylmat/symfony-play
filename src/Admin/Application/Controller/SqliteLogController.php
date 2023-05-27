<?php

namespace App\Admin\Application\Controller;

use App\Local\Domain\Entity\SqliteLog;

class SqliteLogController extends LogController
{
    public static function getEntityFqcn(): string
    {
        return SqliteLog::class;
    }
}
