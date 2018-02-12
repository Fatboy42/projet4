<?php

namespace ML\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dates
 *
 * @ORM\Table(name="dates")
 * @ORM\Entity(repositoryClass="ML\FrontBundle\Repository\DatesRepository")
 */
class Dates
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", unique=true)
     */
    protected $date;

    /**
     * @var int
     *
     * @ORM\Column(name="soldquantity", type="integer", nullable=true)
     */
    protected $soldquantity;

    /**
    * Constructor
    */
    public function __construct()
    {
      $this->soldquantity = 0;
    }


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Dates
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set soldquantity
     *
     * @param integer $soldquantity
     *
     * @return Dates
     */
    public function setSoldquantity($soldquantity)
    {
        $this->soldquantity = $soldquantity;

        return $this;
    }

    /**
     * Get soldquantity
     *
     * @return int
     */
    public function getSoldquantity()
    {
        return $this->soldquantity;
    }

    /*public function incrementTicks($nbre)
    {

      $this->soldquantity++;


    }*/
}
