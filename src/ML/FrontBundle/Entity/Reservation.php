<?php

namespace ML\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use ML\FrontBundle\Validator\PublicHoliday;
use ML\FrontBundle\Validator\UnderOneThousand;



/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="ML\FrontBundle\Repository\ReservationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Reservation
{


    /**
     * @ORM\Column(name="id", type="integer", unique=true, nullable=true)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
     protected $id;


    /**
     * @var int
     * @ORM\Column(name="uniqid", type="string", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Id
     */
     protected $uniqid;

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
     * @ORM\ManyToOne(targetEntity="ML\FrontBundle\Entity\ReservationType", cascade={"persist", "detach", "merge"}, fetch="EAGER")
     */
    protected $reservationtype;

    /**
     * @var \DateTime
     * @PublicHoliday()
     * @UnderOneThousand()
     * @ORM\Column(name="dateform", type="date", unique=false)
     */
    protected $dateform;

     /**
      * @ORM\ManyToOne(targetEntity="ML\FrontBundle\Entity\Dates", cascade={"persist", "detach", "merge"}, fetch="EAGER")
      */
    protected $date;

    /**
     * @ORM\OneToMany(targetEntity="ML\FrontBundle\Entity\Tickets", mappedBy="reservation", cascade={"persist", "remove", "detach", "merge"})
     */
    protected $tickets;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    protected $mail;

    /**
     * @ORM\Column(name="totalprice", type="integer")
     */
     protected $totalprice;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();

        $this->dateform = new \Datetime();

        $this->uniqid = uniqid();
    }


    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Reservation
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
     * @return Reservation
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
     * Set mail
     *
     * @param string $mail
     *
     * @return Reservation
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set reservationtype
     *
     * @param \ML\FrontBundle\Entity\ReservationType $reservationtype
     *
     * @return Reservation
     */
    public function setReservationtype(\ML\FrontBundle\Entity\ReservationType $reservationtype = null)
    {
        $this->reservationtype = $reservationtype;

        return $this;
    }



    /**
     * Get reservationtype
     *
     * @return \ML\FrontBundle\Entity\ReservationType
     */
    public function getReservationtype()
    {
        return $this->reservationtype;
    }

    /**
     * Set date
     *
     * @param \ML\FrontBundle\Entity\Dates $date
     *
     * @return Reservation
     */
    public function setDate(\ML\FrontBundle\Entity\Dates $date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \ML\FrontBundle\Entity\Dates
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Add ticket
     *
     * @param \ML\FrontBundle\Entity\Tickets $ticket
     *
     * @return Reservation
     */
    public function addTicket(\ML\FrontBundle\Entity\Tickets $ticket)
    {
        $this->tickets[] = $ticket;

        $ticket->setReservation($this);

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \ML\FrontBundle\Entity\Tickets $ticket
     */
    public function removeTicket(\ML\FrontBundle\Entity\Tickets $ticket)
    {
        $this->tickets->removeElement($ticket);

        $ticket->setReservation(null); //relation facultative
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set dateform
     *
     * @param \DateTime $dateform
     *
     * @return Reservation
     */
    public function setDateform($dateform)
    {
        $this->dateform = $dateform;

        return $this;
    }

    /**
     * Get dateform
     *
     * @return \DateTime
     */
    public function getDateform()
    {
        return $this->dateform;
    }



    /**
     * Set uniqid
     *
     * @param integer $uniqid
     *
     * @return Reservation
     */
    public function setUniqid($uniqid)
    {
        $this->uniqid = $uniqid;

        return $this;
    }

    /**
     * Get uniqid
     *
     * @return integer
     */
    public function getUniqid()
    {
        return $this->uniqid;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Reservation
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
     * Set totalprice
     */
    public function setTotalprice($price)
    {
      $this->totalprice = $price;

      return $this;
    }

    /**
     * Get totalprice
     */
    public function getTotalprice()
    {
      return $this->totalprice;
    }

    /**
     * @Assert\Callback
     */
    public function isDateValid(ExecutionContextInterface $context)
    {
      $var = $this->getDateform();
      $halfDay = $var->format('d/m/Y');

      $dayOfWeek = $var->format('w');

      $today = date('d/m/Y');

      $hday = explode("/", $halfDay);
      $tday = explode("/", $today);

      $tdy = $tday[2].$tday[1].$tday[0];
      $hlfd = $hday[2].$hday[1].$hday[0];


      $reservation = $this->getReservationtype();
      $idReservation = $reservation->getId();

      if ($tdy == $hlfd and $idReservation == 2 and date('H') >= 14)
      {
        $context
           ->buildViolation('Impossible de reserver un billet demi journée pour le jour meme après 14h')
           ->atPath('dateform')
           ->addViolation()
           ;
      }

      if ($dayOfWeek == 2 || $dayOfWeek == 0)
       {
         $context
            ->buildViolation('Le musée est fermé le dimanche et le mardi')
            ->atPath('dateform')
            ->addViolation()
            ;
        }


    }

    public function ticketsPrice()
    {
       /*$prixformule = array($this->getReservationtype()->getKid(),
                            $this->getReservationtype()->getTeen(),
                            $this->getReservationtype()->getAdult(),
                            $this->getReservationtype()->getSenior()
                            ); //possibilité de mettre getreservationType dans variable

       $student = $this->getReservationType()->getStudent();
       */
      $totalpricee = 0;
      foreach ($this->getTickets() as $value)//$value représente une ligne du tableau, donc une instance tickets
      {
        $birthdate = $value->getBirthdate();
        $rn = new \DateTime();

        $age = $rn->diff($birthdate)->y;

        $value->setAge($age);

        if ($age <= 3)
        {
          $var = $this->getReservationType()->getBaby();
          $value->setPrice($var);
        }

        elseif ($age >= 4 && $age <= 11)
        {
          $var = $this->getReservationType()->getKid();
          $value->setPrice($var);
        }

        elseif ($age >= 12 && $age <= 59)
        {
          $var = $this->getReservationType()->getNormal();
          $value->setPrice($var);
        }

        elseif ($age >= 60)
        {
          $var = $this->getReservationType()->getSenior();
          $value->setPrice($var);
        }

        if ($value->getStudent() == true)
        {
          $reduc = $value->getPrice() - $this->getReservationType()->getStudent();
          if ($reduc < 0) {
            $reduc = 0;
          }
          $value->setPrice($reduc);
        }
      $value->setReservation($this); //etablissement de la relation bidirectionnelle
      $totalpricee += $value->getPrice();

      }

      $this->setTotalprice($totalpricee);
    }

    /**
    * ORM\PreFlush
    */
    /*public function dateIncrement()
    {
      $nbreBillets = $this->getTickets()->count();
      $this->getDate()->incrementTicks($nbreBillets);

    }*/


    /*public function makeRelation()
    {
      $var = $this->getTickets();


      foreach ($var as $value)
      {
        $this->removeTicket($value);
        $this->addTicket($value);  //ok ?? le dernier compte

      }

      $varr = $this->getTickets();
      foreach ($varr as $values)
      {
        //var_dump($values->getReservation());
      }
        //var_dump($this->getTickets());
    }*/
}
