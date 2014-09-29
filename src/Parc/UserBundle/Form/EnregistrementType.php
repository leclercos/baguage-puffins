<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Parc\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseUserType;

class EnregistrementType extends BaseUserType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct()
    {
        
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
		$builder->add('nom','text', array('label' => 'Nom:'))
				->add('username','text', array('label' => 'Pseudo:'))
				->add('plainPassword','text', array('label' => 'Mot de passe:'))
				->add('email','email', array('label' => 'Email:'))
				->add('email','email', array('label' => 'Email:'))
				->add('roleStr','choice', array('choices'=>array(
							"ROLE_USER"  =>'INVITE',
							"ROLE_COLLAB"=>'COLLABORATEUR',
							"ROLE_ADMIN" =>'ADMINISTRATEUR',
						), 'label' => 'Role:'))
				->add('lieudit','choice', array('choices'=>array(
							"" => "",
							"CULIOLI, Jean-Michel"  =>'CULIOLI, Jean-Michel',
							"MANTE, Alain"=>'MANTE, Alain',
							"GILLET, Pascal" =>'GILLET, Pascal',
						), 'label' => 'Responsable:'))
				->add('Enregistrer','submit',array('attr' => array('class' => 'button_submit button_enregistrer' ),));
		
		
		//parent::buildForm($builder, $options);
		
		//$builder->remove('plainPassword');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parc\UserBundle\Entity\Users',
        ));
    }
 
    public function getName()
    {
        return 'parc_user_enregistrementtype';
    }
}
