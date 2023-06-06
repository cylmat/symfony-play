<?php

namespace App\Admin\Application\Controller;

use App\AppBundle\Domain\Entity\Log;
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
class LogController extends AbstractCrudController
{
    protected const ROOT = Log::class;

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

    private function getClassName($next): string
    {
        return substr($next, strrpos($next, '\\')+1);
    }

    /** @SuppressWarnings(PHPMD.ElseExpression) */
    public function redirectToNextController($context)
    {
        $replicateEntities = $this->getParameter('replicateEntities');
        if (array_key_exists(static::getEntityFqcn(), $replicateEntities)) { //root
            $next = $replicateEntities[static::getEntityFqcn()][0];
            $logClass = $this->getClassName(static::getEntityFqcn());
            $oneClass=$this->getClassName($next);

            $oneController=(str_replace($logClass, $oneClass, __CLASS__));

            return $this->redirect($this->container->get(AdminUrlGenerator::class)
                ->setController($oneController)
                ->setAction('flush')
                ->unset(EA::ENTITY_ID)
                ->generateUrl())
            ;
        } else {
            $next = null;
            foreach ($replicateEntities[self::ROOT] as $k => $t) {
                if (static::getEntityFqcn() ===  $t) {
                    $next = $k+1;
                }
            }
            if (isset($replicateEntities[self::ROOT][$next])) {
                $rootClass=$this->getClassName(self::getEntityFqcn());
                $nextClass = $this->getClassName($replicateEntities[self::ROOT][$next]);
                $nextController=(str_replace($rootClass, $nextClass, __CLASS__));

                return $this->redirect($this->container->get(AdminUrlGenerator::class)
                    ->setController($nextController)
                    ->setAction('flush')
                    ->unset(EA::ENTITY_ID)
                    ->generateUrl())
                ;
            }
        }

        return $this->redirect($context->getReferrer()
            ?? $this->container->get(AdminUrlGenerator::class)
                ->setAction(Action::INDEX)
                ->unset(EA::ENTITY_ID)
                ->generateUrl())
            ;
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
        $queryBuilder = $this->createIndexQueryBuilder(
            $context->getSearch(), // @phpstan-ignore-line: SearchDto|null given
            $context->getEntity(),
            $fields,
            $filters
        );
        $paginator = $this->container->get(PaginatorFactory::class)->create($queryBuilder);

        /** @var EntityCollection $entities */
        $entities = $this->container
            ->get(EntityFactory::class)
            ->createCollection($context->getEntity(), $paginator->getResults());

        /** @var EntityManager $doctrine */
        $doctrine = $this->container
            ->get('doctrine')
            ->getManagerForClass($context->getEntity()->getFqcn());

        foreach ($entities->getIterator() as $entity) {
            $doctrine->remove($entity->getInstance());
        }
        $doctrine->flush();

        return $this->redirectToNextController($context);
    }
}
