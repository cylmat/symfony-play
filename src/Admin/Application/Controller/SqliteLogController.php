<?php

namespace App\Admin\Application\Controller;

use App\Local\Domain\Entity\SqliteLog;
use Doctrine\ORM\EntityManager;
use EasyCorp\Bundle\EasyAdminBundle\Collection\EntityCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\EA;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FilterConfigDto;
use EasyCorp\Bundle\EasyAdminBundle\Exception\ForbiddenActionException;
use EasyCorp\Bundle\EasyAdminBundle\Factory\EntityFactory;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FilterFactory;
use EasyCorp\Bundle\EasyAdminBundle\Factory\PaginatorFactory;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Security\Permission;
use Symfony\Component\HttpFoundation\Response;

/* Used for DashboardController */
/** @SuppressWarnings(PHPMD.CouplingBetweenObjects) */
class SqliteLogController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SqliteLog::class;
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

    /** @SuppressWarnings(PHPMD.StaticAccess) */
    public function flush(AdminContext $context): Response
    {
        if (!$this->isGranted(Permission::EA_EXECUTE_ACTION, ['action' => Action::INDEX, 'entity' => null])) {
            throw new ForbiddenActionException($context);
        }

        $fields = FieldCollection::new($this
            ->configureFields(Crud::PAGE_INDEX));
        $context->getCrud()
            ?->setFieldAssets($this->getFieldAssets($fields))
        ;
        $filters = $this->container->get(FilterFactory::class)->create(new FilterConfigDto(), $fields, $context->getEntity());
        /* @phpstan-ignore-next-line: expects SearchDto, SearchDto|null given */
        $queryBuilder = $this->createIndexQueryBuilder(
            $context->getSearch(), $context->getEntity(), $fields, $filters
        );
        $paginator = $this->container->get(PaginatorFactory::class)->create($queryBuilder);

        /*
        $a = $context->getCrud()->getActionsConfig();
        $adto = new ActionDto();
        $adto->setName('flush');
        $a = new ActionConfigDto();
        */

        /** @var EntityCollection $entities */
        $entities = $this->container->get(EntityFactory::class)->createCollection($context->getEntity(), $paginator->getResults());

        /** @var EntityManager $doctrine */
        $doctrine = $this->container->get('doctrine')->getManagerForClass($context->getEntity()->getFqcn());

        foreach ($entities->getIterator() as $entity) {
            $doctrine->remove($entity->getInstance());
        }
        $doctrine->flush();

        if (null !== $referrer = $context->getReferrer()) {
            return $this->redirect($referrer);
        }

        return $this->redirect(
            $this->container->get(AdminUrlGenerator::class)
                ->setAction(Action::INDEX)
                ->unset(EA::ENTITY_ID)
                ->generateUrl()
        );
    }
}
