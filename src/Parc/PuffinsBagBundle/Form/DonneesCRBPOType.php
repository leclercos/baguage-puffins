<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DonneesCRBPOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('theme', 'text', array('required' => false))
            ->add('centre', 'text', array('required' => false))
            ->add('pays', 'text', array('required' => false))
            ->add('dept', 'text', array('required' => false))
            ->add('localite', 'text', array('required' => false))
            ->add('bg', 'text', array('required' => false))
            ->add('sg', 'text', array('required' => false))
            ->add('condRepr', 'integer', array('required' => false))
            ->add('circRepr', 'text', array('required' => false))
            ->add('cs', 'text', array('required' => false))
            ->add('nf', 'text', array('required' => false))
            ->add('es','text', array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\PuffinsBagBundle\Entity\DonneesCRBPO'
        ));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_donneescrbpotype';
    }
}
