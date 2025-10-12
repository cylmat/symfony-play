<?php

namespace App\MainBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * EasyAdmin.
 *
 * @see https://symfonycasts.com/screencast/easyadminbundle
 * @see https://symfony.com/bundles/EasyAdminBundle/current/index.html
 */
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('@EasyAdmin/page/content.html.twig');
    }

    /** @see https://symfony.com/bundles/EasyAdminBundle/current/dashboards.html */
    public function configureDashboard(): Dashboard
    {
        return parent::configureDashboard()
            ->setTitle('Application')
        ;
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->setPaginatorPageSize(9999)
        ;
    }

    /** @SuppressWarnings(PHPMD.StaticAccess) */
    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToCrud('Log', 'fas fa-list', Log::class);
        // yield MenuItem::linkToCrud('SqliteLog', 'fas fa-list', SqliteLog::class);

        yield MenuItem::linkToUrl(
            'Log -FlushAll-',
            'fas fa-list',
            $this->container->get(AdminUrlGenerator::class)
                ->setController(LogController::class)
                ->setAction('flush')
                ->generateUrl()
        );
    }
}
