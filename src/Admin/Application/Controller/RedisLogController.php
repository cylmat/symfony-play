<?php

namespace App\Admin\Application\Controller;

use App\Local\Domain\Entity\RedisLog;
use App\Local\Infrastructure\Manager\RedisPersistanceManager;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\HttpFoundation\Response;

class RedisLogController extends LogController
{
    public function __construct(
        private readonly RedisPersistanceManager $rpm
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return RedisLog::class;
    }

    public function flush(AdminContext $context): Response
    { 
        $this->rpm->flushall();

        if (null !== $referrer = $context->getReferrer()) {
            return $this->redirect($referrer);
        }

        return $this->redirect(
            '/admin'
        );
    }
}
