<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DonneesPNPCType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('primaire', 'text', array('required' => false))
            ->add('secondaire', 'text', array('required' => false))
            ->add('rectrice', 'text', array('required' => false))
            ->add('couV', 'text', array('required' => false))
            ->add('couD', 'text', array('required' => false))
            ->add('rg', 'choice', array('choices'=> array('FALSE'=>'Non', 'TRUE'=>'Oui'),'required' => false))
            ->add('pl', 'choice', array('choices'=> array('FALSE'=>'Non', 'TRUE'=>'Oui'),'required' => false))
            ->add('pr', 'choice', array('choices'=> array('FALSE'=>'Non', 'TRUE'=>'Oui'),'required' => false))
            ->add('asg','choice', array('choices'=> array('FALSE'=>'Non', 'TRUE'=>'Oui'),'required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\PuffinsBagBundle\Entity\DonneesPNPC'
        ));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_donneespnpctype';
    }
}
