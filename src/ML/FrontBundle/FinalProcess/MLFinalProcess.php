<?php

namespace ML\FrontBundle\FinalProcess;

use Doctrine\ORM\EntityManagerInterface;
use ML\FrontBundle\Entity\Reservation;


class MLFinalProcess
{
  private $mailer;
  private $em;
  private $twig;

  public function __construct(EntityManagerInterface $em, \Swift_Mailer $mailer, \Twig_Environment $twig)
  {
    $this->mailer = $mailer;
    $this->em = $em;
    $this->twig = $twig;
  }

  public function finalprocess(Reservation $reservation)
  {
    //$this->em->persist($reservation);
    $var = $this->em->merge($reservation);
    //$this->em->detach($reservation->getReservationType());
    //$this->em->detach($reservation->getDate());
    //var_dump($var);
    var_dump($this->em->contains($var));
    $this->em->flush();

    //var_dump($reservation);

    $body = $this->twig->render('MLFrontBundle:Reservation:mail.html.twig', array('reservation' => $reservation));

    $message = (new \Swift_Message('Votre réservation au Musée du Louvre'))
       ->setFrom('palmino.angelo@gmail.com')
       ->setTo($reservation->getMail())
       ->setBody($body, 'text/html');

    $this->mailer->send($message);


    //envoi du mail et appel au service incrementation

  }

}






 ?>
