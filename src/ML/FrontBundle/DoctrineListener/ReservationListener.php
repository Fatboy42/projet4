<?php

namespace ML\FrontBundle\DoctrineListener;

use Doctrine\ORM\EntityManagerInterface;
use ML\FrontBundle\Entity\Reservation;
use ML\FrontBundle\Entity\Dates;
use Doctrine\ORM\Event\OnFlushEventArgs;


class ReservationListener
{
  /*private $em;

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }*/

  public function onFlush(OnFlushEventArgs $args)
  {
    $em = $args->getEntityManager();
    $uow = $em->getUnitOfWork();

     foreach ($uow->getScheduledEntityInsertions() as $key)
     {
       if ($key instanceof Reservation)
       {
         var_dump($key->getTickets()->count());
         var_dump($key->getDate()->getSoldquantity());
         //var_dump($uow);
         var_dump($uow->getOriginalEntityData($key));

       }


   }





  }
}









 ?>
