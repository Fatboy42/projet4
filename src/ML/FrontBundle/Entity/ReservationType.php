<?php

namespace ML\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationType
 *
 * @ORM\Table(name="reservation_type")
 * @ORM\Entity(repositoryClass="ML\FrontBundle\Repository\ReservationTypeRepository")
 */
class ReservationType
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(name="baby", type="integer")
     */
    protected $baby;

    /**
     * @var int
     *
     * @ORM\Column(name="kid", type="integer")
     */
    protected $kid;

    /**
     * @var int
     *
     * @ORM\Column(name="normal", type="integer")
     */
    protected $normal;

    /**
     * @var int
     *
     * @ORM\Column(name="senior", type="integer")
     */
    protected $senior;

    /**
     * @var int
     *
     * @ORM\Column(name="student", type="integer")
     */
    protected $student;


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
     * Set name
     *
     * @param string $name
     *
     * @return ReservationType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set baby
     *
     * @param integer $baby
     *
     * @return ReservationType
     */
    public function setBaby($baby)
    {
        $this->baby = $baby;

        return $this;
    }

    /**
     * Get baby
     *
     * @return int
     */
    public function getBaby()
    {
        return $this->baby;
    }

    /**
     * Set kid
     *
     * @param integer $kid
     *
     * @return ReservationType
     */
    public function setKid($kid)
    {
        $this->kid = $kid;

        return $this;
    }

    /**
     * Get kid
     *
     * @return int
     */
    public function getKid()
    {
        return $this->kid;
    }

    /**
     * Set normal
     *
     * @param integer $normal
     *
     * @return ReservationType
     */
    public function setNormal($normal)
    {
        $this->normal = $normal;

        return $this;
    }

    /**
     * Get normal
     *
     * @return int
     */
    public function getNormal()
    {
        return $this->normal;
    }

    /**
     * Set senior
     *
     * @param integer $senior
     *
     * @return ReservationType
     */
    public function setSenior($senior)
    {
        $this->senior = $senior;

        return $this;
    }

    /**
     * Get senior
     *
     * @return int
     */
    public function getSenior()
    {
        return $this->senior;
    }

    /**
     * Set student
     *
     * @param integer $student
     *
     * @return ReservationType
     */
    public function setStudent($student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return int
     */
    public function getStudent()
    {
        return $this->student;
    }
}
