<?php

namespace ML\FrontBundle\Validator;


use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
 class PublicHoliday extends Constraint
 {
   public $message = "Impossible de reserver pour un jour férié";
 }












 ?>
