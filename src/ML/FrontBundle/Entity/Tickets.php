<?php

namespace ML\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Tickets
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="ML\FrontBundle\Repository\TicketsRepository")
 */
class Tickets
{

   /**
    * @ORM\Column(name="id", type="integer", unique=true, nullable=true)
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
     protected $id;


    /**
     * @ORM\Column(name="uniqTickId", type="string", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
     protected $uniqTickId;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    protected $birthdate;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    protected $age;

    /**
     * @ORM\Column(name="student", type="boolean", nullable=true)
     */
     protected $student;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    protected $price;

    /**
     * @ORM\ManyToOne(targetEntity="ML\FrontBundle\Entity\Reservation", inversedBy="tickets")
     * @ORM\JoinColumn(name="reservation_id", referencedColumnName="uniqid")
     */
    protected $reservation;

    public function __construct()
    {
      $this->uniqTickId = uniqid();

      $this->birthdate = new \Datetime();
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Tickets
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Tickets
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Tickets
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Tickets
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Tickets
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set reservation
     *
     * @param \ML\FrontBundle\Entity\Reservation $reservation
     *
     * @return Tickets
     */
    public function setReservation(\ML\FrontBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \ML\FrontBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set uniqTickId
     *
     * @param integer $uniqTickId
     *
     * @return Tickets
     */
    public function setUniqTickId($uniqTickId)
    {
        $this->uniqTickId = $uniqTickId;

        return $this;
    }

    /**
     * Get uniqTickId
     *
     * @return integer
     */
    public function getUniqTickId()
    {
        return $this->uniqTickId;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Tickets
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set student
     *
     * @param boolean $student
     *
     * @return Tickets
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return boolean
     */
    public function getStudent()
    {
        return $this->student;
    }
}
