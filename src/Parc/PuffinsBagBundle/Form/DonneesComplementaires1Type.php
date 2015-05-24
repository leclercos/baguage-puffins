<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DonneesComplementaires1Type extends DonneesComplementairesType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		parent::buildForm($builder, $options);
		$builder->remove('pr1');
		$builder->remove('pr2');
		$builder->add('pr1', 'text', array('required' => false, 'disabled' => true, 'help' => "Parent 1 de l'oiseau "))
				->add('pr2', 'text', array('required' => false, 'disabled' => true, 'help' => "Parent 2 de l'oiseau "));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_donneescomplementaires1type';
    }
}