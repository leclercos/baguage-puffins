<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModifierDonneesType extends DonneesPrincipalesType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		parent::buildForm($builder, $options);		
		$builder->remove('sauvegarder');
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_modifierdonneestype';
    }
}