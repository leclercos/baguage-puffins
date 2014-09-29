<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DonneesComplementairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nature', 'text', array('required' => false, 'help' => 'La nature du terrier'))
            ->add('rmqTerrier', 'text', array('required' => false, 'help' => 'Autres remarques concernant le terrier'))
            //->add('periodeJN', 'text', array('required' => false))
            //->add('stade', 'text', array('required' => false))
			->add('ptd', 'text', array('required' => false, 'help' => "Partenaire de l'oiseau "))
			->add('pr1', 'text', array('required' => false, 'help' => "Parent 1 de l'oiseau "))
			->add('pr2', 'text', array('required' => false, 'help' => "Parent 2 de l'oiseau "))
            ->add('lp', 'number', array('required' => false, 'help' => "Longueur de l'aile (en mm) "))
            ->add('memo', 'textarea', array('required' => false))
            ->add('bc', 'number', array('required' => false, 'help' => "Hauteur du bec depuis la base du crâne (en mm)"))
            ->add('bh', 'number', array('required' => false, 'help' => "Longeur du bec (en mm)"))
            //->add('lt', 'number', array('required' => false))
            ->add('ma', 'number', array('required' => false, 'help' => "Poids de l'oiseau (en g)"))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\PuffinsBagBundle\Entity\DonneesComplementaires'
        ));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_donneescomplementairestype';
    }
}
