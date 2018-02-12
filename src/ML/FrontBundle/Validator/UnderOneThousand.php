<?php

namespace ML\FrontBundle\Validator;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
 class UnderOneThousand extends Constraint
 {
   public $message = "Jour Complet";
   public $messagedeux = "Nombre de billets restant pour ce jour insufisant";

   public function validatedBy()
   {
     return 'ml_frontbundle_underonethousand';
   }
 }







 ?>
