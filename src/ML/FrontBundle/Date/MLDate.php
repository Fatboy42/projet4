<?php

namespace ML\FrontBundle\Date;

use Doctrine\ORM\EntityManagerInterface;

class MLDate
{
   private $em;
   private $limit;

   public function __construct(EntityManagerInterface $em, $limit)
   {
     $this->em = $em;
     $this->limit = $limit;
   }

   public function check($date)
   {
     $exist = $this->em
        ->getRepository('MLFrontBundle:Dates')
        ->findOneByDate($date);

      if ($exist)
      {
        if ($exist->getSoldquantity() >= $this->limit)
        {
          return false;
        }
      }
   }


}




 ?>
