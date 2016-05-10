<?php

namespace JamBundle\Services;

/**
 * Class CloneService
 * @package JamBundle\Services
 */
class CloneService
{
    /**
     * @param $object
     * @return mixed
     */
    public function cloneObject($object)
    {
        return clone $object;
    }
}
