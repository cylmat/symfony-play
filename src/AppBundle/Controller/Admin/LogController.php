<?php

namespace App\AppBundle\Controller\Admin;

use App\AppBundle\Entity\Log;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LogController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Log::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions
            ->disable(Action::NEW)
            ->disable(Action::EDIT)
            ->disable(Action::DELETE)
        ;

        return $actions;
    }
}
