<?php

namespace JamBundle\Services;

use Doctrine\ORM\EntityManager;

/**
 * Class JamJarService
 * @package JamBundle\Services
 */
class JamJarService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * JamJarService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $object
     * @param $count
     */
    public function cloneJam($object, $count)
    {
        for ($i = 1; $i < $count; $i++) {
            $this->entityManager->persist(clone $object);
        }

        $this->entityManager->flush();
    }
}
