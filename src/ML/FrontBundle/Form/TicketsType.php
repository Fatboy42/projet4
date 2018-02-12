<?php

namespace ML\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class TicketsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $var = range(date('d'), date('t'));
        $var = count($var)-1;

        $builder
        ->add('firstname', TextType::class)
        ->add('lastname',  TextType::class)
        ->add('birthdate', DateType::class, array(
          'widget' => 'choice',
          'years' => range(date('Y'), date('Y')-100),
          //'months' => range(date('m'), date('m')),
          //'days'  => range(date('d'), date('d')-$var),
        ))
        ->add('student',   CheckboxType::class, array(
          'required' => false,
        ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ML\FrontBundle\Entity\Tickets'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ml_frontbundle_tickets';
    }


}
