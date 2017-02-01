<?php


namespace covoiturage\userBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',null,array('label' => '*Nom'))->add('prenom',null,array('label' => '*Prénom'))->add('sexe',ChoiceType::class,array(



                'choices' => array('homme'=> 'homme', 'femme' => 'femme')
            ))->add('tabagisme',ChoiceType::class,array(

            'choices'=>array('fumeur'=> true, 'non fumeur' => false)
            ))->add('musique')->add('telephone')->add('animaux',ChoiceType::class,array(


                'choices'=>array('Accepte'=> true, 'Refuse' => false)
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}