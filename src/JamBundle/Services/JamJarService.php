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
     * @var CloneService
     */
    protected $cloneService;

    /**
     * JamJarService constructor.
     * @param EntityManager $entityManager
     * @param CloneService $cloneService
     */
    public function __construct(EntityManager $entityManager, CloneService $cloneService)
    {
        $this->entityManager = $entityManager;
        $this->cloneService  = $cloneService;
    }

    /**
     * @param $object
     * @param $count
     */
    public function cloneJam($object, $count)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->entityManager->persist(
                $this->cloneService->cloneObject($object)
            );
        }

        $this->entityManager->flush();
    }
}
