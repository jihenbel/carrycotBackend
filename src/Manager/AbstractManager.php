<?php


namespace App\Manager;


use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractManager
{
    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    protected function save($object)
    {
        $this->persist($object);
        $this->flush();
        return $object->getId();
    }

    protected function persist($object)
    {
        $this->manager->persist($object);
    }

    protected function flush()
    {
        $this->manager->flush();
    }
}
