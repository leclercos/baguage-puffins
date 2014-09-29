<?php

namespace Parc\PuffinsBagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DonneesPrincipalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('lieudit', 'text', array('help' => 'Lieu du baguage', 'translation_domain' => 'ParcPuffinsBagBundle'))
			->add('bg', 'text', array('help' => 'Bagueur principal, le nom doit etre de type NOM, Prenom.', 'translation_domain' => 'ParcPuffinsBagBundle'))
			->add('sg', 'text', array('required'=>false, 'help' => 'Stagiaire, le nom doit etre de type: NOM, Prenom.', 'translation_domain' => 'ParcPuffinsBagBundle'))
            ->add('espece', 'choice', array('choices'=>array("CALDIO" =>'CALDIO', "PUFYEL"=>'PUFYEL')))
            ->add('action', 'choice', array('choices'=>array('B' =>'B','C' =>'C','R' =>'R')))
			->add('condRepr','choice', array('required'=>false, 'choices'=>array(
					0 => 'Tolalement inconnues',
					1 => 'Sans infos sur la date de la mort',
					2 => 'Mort récente',
					3 => 'Mort ancienne',
					4 => 'Trouvé Malade, blessé ou relaché',					
					6 => 'Vivant et probablement en bonne santé mais garde en captivité',					
					8 => 'Vivant et en bonne santé et relâché par un bagueur',					
					),
					'help' => "Champ obligatoire en cas de controle ou de reprise d'un oiseau. Pour plus d'informations voir le guide de saisie CRBPO",
					'translation_domain' => 'ParcPuffinsBagBundle'))
			->add('circRepr','choice', array('required'=>false, 'choices'=>array(
					99 => 'Aucune information',
					61 => 'Tué par un chat',
					62 => 'Tué par un animal domestique',
					60 => 'Tué par un animal inconnu',
					16 => 'Tiré pour lire la bague ou le marquage',
					),
					'help' => "Champ obligatoire en cas de controle ou de reprise d'un oiseau. Pour plus d'informations voir le guide de saisie CRBPO",
					'translation_domain' => 'ParcPuffinsBagBundle'))
            ->add('bague', 'text', array('help' => 'La bague doit etre composée de 2 lettres et de 5(PUFYEL)ou 6 chiffres AA00001(0).', 'translation_domain' => 'ParcPuffinsBagBundle'))
            ->add('colonie', 'text', array('required'=>false))
            ->add('secteur', 'text', array('required'=>false))
            ->add('terrier', 'text', array('required'=>false))
            ->add('date', 'date')
            ->add('heure', 'time')
            ->add('sexe', 'choice', array('choices'=>array('M' =>'M','F' =>'F', '?'=>'?')))
            ->add('age', 'choice', array('choices'=>array('PUL' =>'PUL','VOL' =>'VOL', '?'=>'?')))
            ->add('donneesComplementaires',new DonneesComplementairesType())
            ->add('donneesPNPC',new DonneesPNPCType(), array('required'=>false))
            ->add('autresMesures', new AutresMesuresType(), array('required'=>false))
			->add('sauvegarder', 'checkbox', 
								array('label' =>'Dupliquer',
								'required'=>false, 
								'help' => "Permet d'enregister une nouvelle donnée sur la base de l'ancienne "))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\PuffinsBagBundle\Entity\DonneesPrincipales',
			'validation_groups' => array('importer', ''),
        ));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_donneesprincipalestype';
    }
}
