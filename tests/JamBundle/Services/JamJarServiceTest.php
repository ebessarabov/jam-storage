<?php

namespace Tests\JamBundle\Services;

use Doctrine\ORM\EntityManager;
use JamBundle\Entity\JamJar;
use JamBundle\Services\CloneService;
use JamBundle\Services\JamJarService;

class JamJarServiceTest extends \PHPUnit_Framework_TestCase
{
    const COUNT = 5;

    public function testCloneJam()
    {
        $jamJar = $this->getMock(JamJar::class);
        $cloneService = $this->getMock(CloneService::class);

        $cloneService->expects($this->exactly($this::COUNT))
            ->method('cloneObject')
            ->with($jamJar)
        ;

        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $em->expects($this->exactly($this::COUNT))
            ->method('persist');

        $em->expects($this->once())
            ->method('flush');

        $jamJarService = new JamJarService($em, $cloneService);
        $jamJarService->cloneJam($jamJar, $this::COUNT);
    }
}
