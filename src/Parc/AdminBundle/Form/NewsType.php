<?php

namespace Parc\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet')
            ->add('contenu')
            ->add('dateDebut')
            ->add('dateFin')
			->add('Enregistrer','submit',array('attr' => array('class' => 'button_submit button_enregistrer' ),));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\AdminBundle\Entity\News'
        ));
    }

    public function getName()
    {
        return 'parc_adminbundle_newstype';
    }
}
