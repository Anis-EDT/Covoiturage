<?php

namespace covoiturage\userBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class voitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('marque')->add('comfort',ChoiceType::class,array(



            'choices' => array('peu comfortable'=> 'peu comfortable', 'comfortable' => 'comfortable', 'Tres comfortable' => 'Tres comfortable')
        ))->add('nbPlaces')->add('couleur')->add('categorie',ChoiceType::class,array(



            'choices' => array('Familiale'=> 'Familiale', 'Mini' => 'Mini', 'Luxe  Sport' => 'Luxe  Sport')
        ))       ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'covoiturage\userBundle\Entity\voiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'covoiturage_userbundle_voiture';
    }


}
