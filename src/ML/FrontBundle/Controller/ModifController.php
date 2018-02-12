<?php

namespace ML\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use ML\FrontBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ML\FrontBundle\Form\TicketsType;



class ModifController extends Controller
{
    public function modifAction(Request $request)
    {
        $session = $request->getSession()->get('reservation');

        if ($session)
        {
          // $em = $this->getDoctrine()->getManager();
           //$em->persist($session);

           $formbuilder = $this->get('form.factory')->createBuilder(FormType::class, $session);

           $formbuilder
             ->add('firstname',  TextType::class, array('label' => 'Prenom'))
             ->add('lastname',    TextType::class, array('label' => 'Nom'))
             ->add('reservationtype', EntityType::class, array(
               'class'        => 'MLFrontBundle:ReservationType',
               'choice_label' => 'name',
               'multiple'     => false,
               'label'        => 'Formule',
             ))
             ->add('dateform', DateType::class, array(
               'label' => 'Date de reservation',
               'widget' => 'choice',
               'years' => range(date('Y'), date('Y')+10),
               'months' => range(date('m'), 12),
               'days' => range(date('d'), 31),
             ))
             ->add('mail', TextType::class, array('label' => 'Adresse Mail'))
             ->add('tickets', CollectionType::class, array(
               'entry_type'    => TicketsType::class,
               'allow_add'     => true,
               'allow_delete'  => true
             ))
             ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
             ;

           $form = $formbuilder->getForm();

           if ($request->isMethod('POST'))
           {
             $form->handleRequest($request);

             if ($form->isValid())
             {  //service
               $service = $this->get('ml_frontbundle.datemanager');
               $var = $service->dateManager($session->getDateform());

               //$em = $this->getDoctrine()->getManager();
               //$em->persist($session);

               $session->setDate($var);

               $session->ticketsPrice();

               //$session->makeRelation();

               //$em->detach($session);

               $request->getSession()->set('reservation', $session);

               return $this->redirectToRoute('ml_front_recap');

             }
           }


           return $this->render('MLFrontBundle:Reservation:addform.html.twig', array(
             'form' => $form->createView(),
           ));
        }
        else
        {
          return $this->redirectToRoute('ml_front_homepage');
        }
    }


}






 ?>
