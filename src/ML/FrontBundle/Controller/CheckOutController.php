<?php

namespace ML\FrontBundle\Controller;


use Symfony\Component\HttpFoundation\Session\Session;
use ML\FrontBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class CheckOutController extends Controller
{

  public function checkOutAction(Request $request)
  {
    $session = $request->getSession()->get('reservation');
    $soldQuantityService = $this->get('ml_frontbundle.checkquantity');
    $var = $soldQuantityService->quantityChecker($session->getDateform());


    if ($request->isMethod('POST'))
    {
      if ($session) //redirect hpmepage si existe pas
      {
        if ($var)
        {
          $tickets = $session->getTickets()->count();//nombre de billets souhaités
          $quantity = $var->getSoldquantity();//nombre de billets vendus
          if ($tickets + $quantity > 1000)
          {
            $this->addFlash('alert', 'Quantité de billets insuffisante pour la date selectionnée, choisissez en une autre. VOUS N\'AVEZ PAS ETE DÉBITÉ');
            return $this->redirectToRoute('ml_front_modif');
          }
          else {
            $total = $session->getTotalprice();
            $cents = bcmul($total, 100);

            \Stripe\Stripe::setApiKey("sk_test_thKPs6umIGcvNc5dGyPUVmGl");

           // Get the credit card details submitted by the form
           $token = $_POST['stripeToken'];

           // Create a charge: this will charge the user's card
           try {
               $charge = \Stripe\Charge::create(array(
                   "amount" => $cents, // Amount in cents
                   "currency" => "eur",
                   "source" => $token,
                   "description" => "Musée du Louvre - Reservation"
               ));
               $this->addFlash("success","Bravo ça marche !");
               $service = $this->get('ml_frontbundle.finalprocess');
               $service->finalprocess($session);
               $sessionn = $request->getSession()->get('reservation');
               //$request->getSession()->remove('reservation');


               //var_dump($sessionn);
               //var_dump($charge);
               return $this->render("MLFrontBundle:Reservation:success.html.twig", array(
                 'mail' => $session->getMail()
               )); //render pour mail
           } catch(\Stripe\Error\Card $e) {

               $this->addFlash("error","Payement refusé");
               return $this->redirectToRoute("ml_front_recap");
               // The card has been declined
           }
          }
        }
        else { //var
          $total = $session->getTotalprice();
          $cents = bcmul($total, 100);

          \Stripe\Stripe::setApiKey("sk_test_thKPs6umIGcvNc5dGyPUVmGl");

         // Get the credit card details submitted by the form
         $token = $_POST['stripeToken'];

         // Create a charge: this will charge the user's card
         try {
             $charge = \Stripe\Charge::create(array(
                 "amount" => $cents, // Amount in cents
                 "currency" => "eur",
                 "source" => $token,
                 "description" => "Musée du Louvre - Reservation"
             ));
             $this->addFlash("success","Bravo ça marche !");
             $service = $this->get('ml_frontbundle.finalprocess');
             $service->finalprocess($session);
             $request->getSession()->remove('reservation');
             $sessionn = $request->getSession()->get('reservation');

             var_dump($sessionn);
             var_dump($charge);
             return $this->render("MLFrontBundle:Reservation:success.html.twig", array(
               'mail' => $session->getMail()
             )); //render pour mail
         } catch(\Stripe\Error\Card $e) {

             $this->addFlash("error","Payement refusé");
             return $this->redirectToRoute("ml_front_recap");
             // The card has been declined
         }
        }


      }

    }

    else
    {
      //verif <1000
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
          }
        }
        else
        {
           return $this->redirectToRoute('ml_front_homepage');
        }
      }

      if ($session->getTotalprice() == 0)
      {
        $this->addFlash("success","Bravo ça marche !");
        $service = $this->get('ml_frontbundle.finalprocess');
        $service->finalprocess($session);
        $request->getSession()->remove('reservation');

        return $this->render("MLFrontBundle:Reservation:success.html.twig", array(
          'mail' => $session->getMail()
        ));
      }
      else
      {
        return $this->render('MLFrontBundle:Reservation:checkout.html.twig');
      }

    }

  }

}





 ?>
