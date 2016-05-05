<?php

namespace JamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JamYear
 *
 * @ORM\Table(name="jam_years")
 * @ORM\Entity()
 */
class JamYear
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", unique=true)
     */
    private $year;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return JamYear
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getYear();
    }
}
