<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DonneesLocalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lieudit')
            ->add('codeIle')
            ->add('bagueur')
            ->add('theme')
            ->add('centre')
            ->add('pays')
            ->add('dept')
            ->add('localite')
            ->add('Validez','submit',array('attr' => array('class' => 'button_submit button_enregistrer' ),))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\PuffinsBagBundle\Entity\DonneesLocalisation'
        ));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_donneeslocalisationtype';
    }
}
