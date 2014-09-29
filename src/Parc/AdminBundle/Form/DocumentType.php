<?php

namespace Parc\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DocumentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $container = new ContainerBuilder();
		$builder
            ->add('fichier','file')
            ->add('categorie','choice', array('choices'=>array("Baguage" =>'Baguage', "Formulaire"=>'Formulaire', "Divers"=>'Divers')))
            ->add('nom')
            ->add('Enregistrer','submit',array('attr' => array('class' => 'button_submit button_enregistrer' ),))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\AdminBundle\Entity\Document'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parc_adminbundle_document';
    }
}
