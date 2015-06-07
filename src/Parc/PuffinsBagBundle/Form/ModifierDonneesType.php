<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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