<?php

namespace ML\FrontBundle\Validator;

use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use ML\FrontBundle\CheckQuantity\MLCheckQuantity;


class UnderOneThousandValidator extends ConstraintValidator
{

  private $service;

  public function __construct(MLCheckQuantity $service)
  {
    $this->service = $service;
  }

  public function validate($value, Constraint $constraint)
  {

    $var = $this->service->quantityChecker($value);
    $nbrebillets = $this->context->getRoot()->getData();


    $billets = $nbrebillets->getTickets()->count();//nombre de billets choisi par le visiteur
    var_dump($billets);


     if ($var)
     {
       $quantity = $var->getSoldquantity();
        var_dump($quantity);
         if ($quantity >= 1000)
         {
           $this->context->addViolation($constraint->message);
         }
         if ($quantity + $billets > 1000)
         {
           $this->context->addViolation($constraint->messagedeux);
         }


     }

  }

}




 ?>
