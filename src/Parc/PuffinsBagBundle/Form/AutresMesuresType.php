<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AutresMesuresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('champ1', 'number', array('required' => false))
            ->add('champ2', 'number', array('required' => false))
            ->add('champ3', 'number', array('required' => false))
            ->add('champ4', 'number', array('required' => false))
            ->add('mesure1', 'number', array('required' => false, 'invalid_message' => 'Le champ doit etre un nombre'))
            ->add('mesure2', 'number', array('required' => false, 'invalid_message' => 'Le champ doit etre un nombre'))
            ->add('mesure3', 'number', array('required' => false, 'invalid_message' => 'Le champ doit etre un nombre'))
            ->add('mesure4', 'number', array('required' => false, 'invalid_message' => 'Le champ doit etre un nombre'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\PuffinsBagBundle\Entity\AutresMesures'
        ));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_autresmesurestype';
    }
}
