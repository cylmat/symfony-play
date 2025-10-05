<?php

//use ramsey/uuid
namespace App\MainBundle\DataFixtures;

class FixturesHelper
{
    // public static function assignEntityUuid(ObjectManager $manager, object $entity, string $defaultUuidValue = null): void
    // {
    //     $uuidValue = $defaultUuidValue ?? (new UuidGenerator())->generateId($manager, $entity)->toString();
    //     $uuid = (new UuidFactory())->fromString($uuidValue);

    //     $metadata = $manager->getClassMetaData($entity::class);
    //     $metadata->setIdGenerator(new AssignedGenerator());
    //     $metadata->setFieldValue($entity, 'id', $uuid);
    // }
}
