# Info

- AppEntityRegistry:
    * Use DoctrineRegistry to persist() and remove() Entity in Doctrine
    * Use AppEntityManagers[] to save() and delete() Entity in other DB

- AppRepositoryRegistry:
    * Use AppRepositoryInterface to manage all no-doctrine DB registries

- AbstractAppRepository:
    * Inherit from ServiceEntityRepository
        - find($query) Doctrine entity
    * Set the entity name

---
* AppEntityManagerInterface
    - save()
    - delete()

* AppRepositoryInterface
    - flushall($entity)
    - truncate()

---
(like one Doctrine->EntityManager and multi Repositories)
Autowiring : ManagerRegistry $registry->getManagerForClass($entity::class), doctrine.orm.default_entity_manager

For controller:
    - EntityManagerInterface $entityManager->persist($entity);
    - EntityManagerInterface $entityManager->getRepository(Entity::class)->find($id);