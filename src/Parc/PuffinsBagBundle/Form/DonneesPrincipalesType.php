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

class DonneesPrincipalesType extends AbstractType
{
	private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('lieudit', 'entity', array(
					'class' => 'ParcPuffinsBagBundle:DonneesLocalisation',
					'property' => 'lieudit',
					'help' => 'Lieu du baguage',
					'required'=>false,
					'translation_domain' => 'ParcPuffinsBagBundle',				
					'query_builder' => 
						function(\Parc\PuffinsBagBundle\Entity\DonneesLocalisationRepository $r){
							$user = $this->securityContext->getToken()->getUser();
							return $r->getListLieudit($user->getResponsable(),$user->getRoles()[0]);
						}
				))
			->add('bg', 'entity', array(
					'class' => 'ParcPuffinsBagBundle:BagueurBG',
					'property' => 'nomCRBPO',
					'help' => 'Bagueur principal, le nom doit etre de type NOM, Prenom', 
					'required'=>true,
					'translation_domain' => 'ParcPuffinsBagBundle',				
					'query_builder' => 
						function(\Parc\PuffinsBagBundle\Entity\BagueurBGRepository $r){
							$user = $this->securityContext->getToken()->getUser();
							return $r->getListBagueurs($user->getResponsable(),$user->getRoles()[0]);
						}
				))
			->add('sg', 'text', array('required'=>false, 'help' => 'Stagiaire, le nom doit etre de type: NOM, Prenom.', 'translation_domain' => 'ParcPuffinsBagBundle'))
            ->add('espece', 'choice', array('choices'=>array("CALDIO" =>'CALDIO', "PUFYEL"=>'PUFYEL')))
            ->add('action', 'choice', array('choices'=>array('B' =>'B','C' =>'C','R' =>'R')))
            ->add('bague', 'text', array('help' => 'La bague doit etre composée de 2 lettres et de 5(PUFYEL)ou 6 chiffres AA00001(0).', 'translation_domain' => 'ParcPuffinsBagBundle'))
           // ->add('colonie', 'text', array('required'=>false))
            ->add('secteur', 'text', array('required'=>false))
            ->add('terrier', 'text', array('required'=>false))
            ->add('date', 'date')
            ->add('heure', 'time', array('required'=>false))
            ->add('sexe', 'choice', array('choices'=>array('M' =>'M','F' =>'F', '?'=>'?')))
            ->add('age', 'choice', array('choices'=>array('PUL' =>'PUL','VOL' =>'VOL', '+1A'=>'+1A')))
            //->add('donneesComplementaires',new DonneesComplementairesType())
            ->add('donneesPNPC',new DonneesPNPCType(), array('required'=>false))
            ->add('autresMesures', new AutresMesuresType(), array('required'=>false))
			->add('sauvegarder', 'checkbox', 
								array('label' =>'Dupliquer',
								'required'=>false, 
								'help' => "Permet d'enregister une nouvelle donnée sur la base de l'ancienne "))
        ;
		
		$formModifier = function(FormInterface $form, $lieudit) {            
			if(null !== $lieudit){
				$colonies = $lieudit->getColonies();				
				$form->add('colonie', 'entity', array(
					'required' => true,
					'class' => 'ParcPuffinsBagBundle:Colonie',
					'property' => 'colonie',
					'choices' => $colonies)
				);
			}else{
				$form->add('colonie', 'text', array('required'=>false));
			}
        };
		$builder->addEventListener(
			FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getLieudit());
            }
        );
		$builder->get('lieudit')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($formModifier) {
                // Il est important de récupérer ici $event->getForm()->getData(),
                // car $event->getData() vous renverra la données initiale (vide)
                $lieudit = $event->getForm()->getData();

                // puisque nous avons ajouté l'écouteur à l'enfant, il faudra passer
                // le parent aux fonctions de callback!
                $formModifier($event->getForm()->getParent(), $lieudit);
            }
        );
		
		$formModifierAction = function(FormInterface $form, $action) {            
			if(null === $action || $action == 'B') {
				$form->add('condRepr','text', array(
							'required'=>false,
							'disabled' => true,
							'help' => "Champ obligatoire en cas de controle ou de reprise d'un oiseau. Pour plus d'informations voir le guide de saisie CRBPO",
							'translation_domain' => 'ParcPuffinsBagBundle'))
					 ->add('circRepr','text', array(
						'disabled'=>true, 
						'help' => "Champ obligatoire en cas de controle ou de reprise d'un oiseau. Pour plus d'informations voir le guide de saisie CRBPO",
						'translation_domain' => 'ParcPuffinsBagBundle'));				
			}else{
				$form->add('condRepr', 'entity', array(
							'class' => 'ParcPuffinsBagBundle:ConditionReprise',
							'property' => 'libelle',
							'help' => "Champ obligatoire en cas de controle ou de reprise d'un oiseau. Pour plus d'informations voir le guide de saisie CRBPO",
							'translation_domain' => 'ParcPuffinsBagBundle'))
					 ->add('circRepr', 'entity', array(
							'class' => 'ParcPuffinsBagBundle:CirconstanceReprise',
							'property' => 'libelle',
							'help' => "Champ obligatoire en cas de controle ou de reprise d'un oiseau. Pour plus d'informations voir le guide de saisie CRBPO",
							'translation_domain' => 'ParcPuffinsBagBundle'));
			}
        };
		$builder->addEventListener(
			FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($formModifierAction) {
                $data = $event->getData();
                $formModifierAction($event->getForm(), $data->getAction());
            }
        );
		
		$builder->get('action')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($formModifierAction) {
                $action = $event->getForm()->getData();
                $formModifierAction($event->getForm()->getParent(), $action);
            }
        );
		$formModifierAge = function(FormInterface $form, $age) {            
			if(null === $age || $age == 'PUL') {
				$form->add('donneesComplementaires',new DonneesComplementairesType());				
			}else{
				$form->add('donneesComplementaires',new DonneesComplementaires1Type());
			}
		};
		$builder->addEventListener(
			FormEvents::PRE_SET_DATA,
			function(FormEvent $event) use ($formModifierAge) {
				$data = $event->getData();
				$formModifierAge($event->getForm(), $data->getAction());
			}
		);	
		$builder->get('age')->addEventListener(
			FormEvents::POST_SUBMIT,
			function(FormEvent $event) use ($formModifierAge) {
				$age = $event->getForm()->getData();
				$formModifierAge($event->getForm()->getParent(), $age);
			}
		);
    }
	
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\PuffinsBagBundle\Entity\DonneesPrincipales',
			'validation_groups' => array('importer', ''),
        ));
		//$resolver->setOptional(array('image_path'));
    }

    public function getName()
    {
        return 'parc_puffinsbagbundle_donneesprincipalestype';
    }
}
