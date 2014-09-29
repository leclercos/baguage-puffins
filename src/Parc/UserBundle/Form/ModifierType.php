<?php

namespace Parc\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModifierType extends EnregistrementType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		parent::buildForm($builder, $options);
		
		$builder->remove('username');
		$builder->remove('plainPassword');
    }

    public function getName()
    {
        return 'parc_user_modifiertype';
    }
}
