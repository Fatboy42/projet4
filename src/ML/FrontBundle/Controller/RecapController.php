<?php

namespace ML\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use ML\FrontBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class RecapController extends Controller
{

  public function viewRecapAction(Request $request)
  {
    $session = $request->getSession()->get('reservation');
    $soldQuantityService = $this->get('ml_frontbundle.checkquantity');
    $var = $soldQuantityService->quantityChecker($session->getDateform());

    if ($session)
    {
      if ($var)
      {
        $tickets = $session->getTickets()->count();//nombre de billets souhaités
        $quantity = $var->getSoldquantity();//nombre de billets vendus
        if ($tickets + $quantity > 1000)
        {
          $this->addFlash('alert', 'Quantité de billets insuffisante pour la date selectionnée, choisissez en une autre.');
          return $this->redirectToRoute('ml_front_modif');
          # redirection vers la page de modif avec message flash
        }
        else
        {
          return $this->render('MLFrontBundle:Reservation:recap.html.twig', array(
            'reservation' => $session,
          ));

          dump($session);
        }
      }
      else {
        return $this->render('MLFrontBundle:Reservation:recap.html.twig', array(
          'reservation' => $session,
        ));

        dump($session);
      }

    }

    else
    {
      return $this->redirectToRoute('ml_front_homepage');
    }

  }
}





 ?>
