# Info

(like one Doctrine->EntityManager and multi Repositories)
Autowiring : ManagerRegistry, doctrine.orm.default_entity_manager

-> @todo AppEntityRegistry manage appmanagers[] (like ->getManager)
-> @todo new AppEntityManager implements save() and remove()

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