<?php

namespace Parc\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Parc\PuffinsBagBundle\Entity\DonneesLocalisation;
use Parc\PuffinsBagBundle\Form\DonneesLocalisationType;

use Parc\UserBundle\Entity\Users;
use Parc\UserBundle\Form\EnregistrementType;
use Parc\UserBundle\Form\ModifierType;

use Parc\AdminBundle\Form\NewsType;
use Parc\AdminBundle\Entity\News;

use Parc\AdminBundle\Form\DocumentType;
use Parc\AdminBundle\Entity\Document;

use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/************************************* USERS ********************************/

class AdminController extends Controller
{
	/**
	* @Secure(roles="ROLE_ADMIN")
	*/
    public function indexAction()
    {
        //return $this->render('ParcAdminBundle:Admin:index.html.twig');
		return $this->redirect($this->generateUrl('parc_admin_users')); 
    }
	
	/**
	* @Secure(roles="ROLE_ADMIN")
	*/
	public function userAction()
    {	
        $em= $this->getDoctrine()->getManager();
		$user= new Users();
		$user->setRoles(array());
		$form = $this->createForm(new EnregistrementType(), $user);
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			
			$form->bind($request);
			//$user->setPlainPassword('azerty123');
			$user->setEnabled(true);
			$roles = array($user->getRoleStr());
			$user->setRoles($roles);
			$user->setResponsable($this->getUser()->getResponsable());
			//if ($form->isValid()) 
			{				
				$em->persist($user);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', "L'utilisateur a été bien créé");
				return $this->redirect($this->generateUrl('parc_admin_users'));
			}
		}

		$rpstr= $em->getRepository('ParcUserBundle:Users');
		$users=$rpstr->findAll();
		
		return $this->render('ParcAdminBundle:Admin:utilisateurs.html.twig', array(
			'users' => $users,
			'form' => $form->createView(),
		));
    }
	
	/**
	* @Secure(roles="ROLE_ADMIN")
	*/
	public function userModifierAction(Users $user)
    {	
        $em= $this->getDoctrine()->getManager();
		
		$roles=$user->getRoles();
		$user->setRoleStr($roles[0]);
		
        $form = $this->createForm(new ModifierType(), $user);
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{	
				$roles = array('1'=>$user->getRoleStr());
				$user->setRoles($roles);
				
				$em->persist($user);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', "L'utilisateur a été bien modifié");
				return $this->redirect($this->generateUrl('parc_admin_users'));
			}
			
		}
		return $this->render('ParcAdminBundle:Admin:modifier.html.twig', array(
			'titre' => "de l'utilisateur",
			'form'  => $form->createView(),
		));
    }
	
/* 	/**
	* @Secure(roles="ROLE_USER")
	/
	public function passwordModifierAction()
    {	 
        $em= $this->getDoctrine()->getManager();
		
		$request = $this->get('request');	
		 
		if ($request->getMethod() == 'POST') 
		{
			$password=$this->getRequest()->request->get('password');			
			$user = $this->getUser();
			
			$user->setMdpChanged(true);			
			$user->setPlainPassword($password);
			
			$em->persist($user);
			$em->flush(); 		
			$this->get('session')->getFlashBag()->add('info', 'Le mot de passe a été bien modifié!');
		}
		return $this->redirect($this->generateUrl('parc_puffins_bag_accueil'));
    } */
	
	public function passwordReinitialiserAction(Users $user)
    {	 
        $em= $this->getDoctrine()->getManager();
		
		$request = $this->get('request');			 
		if ($request->getMethod() == 'POST') 
		{
			$user->setMdpChanged(false);			
			$user->setPlainPassword("azerty123");
			
			$em->persist($user);
			$em->flush(); 		
			$this->get('session')->getFlashBag()->add('info', 'Le mot de passe a été bien reinitialisé! Le nouveau mot de passe est azerty123!');
		}
		return $this->redirect($this->generateUrl('parc_admin_users'));
    }
	
	public function userSupprimerAction(Users $user)
    {	
        $em= $this->getDoctrine()->getManager();
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$em->remove($user);
			$em->flush();
		}
		
		$this->get('session')->getFlashBag()->add('info', "L'utilisateur été bien supprimé");
		return $this->redirect($this->generateUrl('parc_admin_users'));
    }
	
/**************************************  DOCUMENTS   ********************************/

	public function docAction()
    {	
        $em= $this->getDoctrine()->getManager();
		$doc = new Document();
        $form = $this->createForm(new DocumentType(), $doc);
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				$user = $this->getUser();
				$doc->setAuteur($user->getNom());
				
				$em->persist($doc);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', 'Le document a été bien ajouté');
				return $this->redirect($this->generateUrl('parc_admin_docs'));
			}
		}
		
		$rpstr= $em->getRepository('ParcAdminBundle:Document');
		$docs=$rpstr->findAll();
		
		return $this->render('ParcAdminBundle:Admin:docs.html.twig', array(
			'form'  => $form->createView(),
			'docs'=> $docs
		));
    }
	
	public function docSupprimerAction(Document $doc)
    {	
        $em= $this->getDoctrine()->getManager();
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$em->remove($doc);
			$em->flush();
			
			$this->get('session')->getFlashBag()->add('info', 'Le document a été bien supprimé');
		}
		
		return $this->redirect($this->generateUrl('parc_admin_docs'));
    }
	
	public function docModifierAction(Document $doc)
    {	
        $em= $this->getDoctrine()->getManager();
        $form = $this->createForm(new DocumentType(), $doc);
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				$em->persist($doc);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', "Le document a été bien modifié");
				return $this->redirect($this->generateUrl('parc_admin_docs'));
			}
		}
		
		return $this->render('ParcAdminBundle:Admin:modifier.html.twig', array(
			'form'  => $form->createView(),
			'titre'	=> 'du document',
		));
    }
	
	/*************************************  NEWS   ********************************/
	
	public function newsAction()
    {	
        $em= $this->getDoctrine()->getManager();
		$news = new News();
        $form = $this->createForm(new NewsType(), $news);
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				$user = $this->getUser();
				$news->setAuteur($user->getNom());
				
				$em->persist($news);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', "Le news a été bien ajouté");
				return $this->redirect($this->generateUrl('parc_admin_news'));
			}
		}
		
		$rpstr= $em->getRepository('ParcAdminBundle:News');
		$all_news=$rpstr->findAll();
		
		return $this->render('ParcAdminBundle:Admin:news.html.twig', array(
			'form'  => $form->createView(),
			'all_news'=> $all_news
		));
    }
	
	public function newsModifierAction(News $news)
    {	
        $em= $this->getDoctrine()->getManager();
        $form = $this->createForm(new NewsType(), $news);
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				$em->persist($news);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', "Le news a été bien modifié");
				return $this->redirect($this->generateUrl('parc_admin_news'));
			}
		}
		
		return $this->render('ParcAdminBundle:Admin:modifier.html.twig', array(
			'form'  => $form->createView(),
			'titre'	=> 'du news',
		));
    }
	
	public function newsSupprimerAction(News $news)
    {	
        $em= $this->getDoctrine()->getManager();
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$em->remove($news);
			$em->flush();
		}
		$this->get('session')->getFlashBag()->add('info', "Le news a été bien supprimé");
		return $this->redirect($this->generateUrl('parc_admin_news'));
    }
	
	
/*************************************  LOCALISATION   ********************************/
	
	public function localAction()
    {	
        $em= $this->getDoctrine()->getManager();
		
		$local = new DonneesLocalisation();
        $form = $this->createForm(new DonneesLocalisationType(), $local);
		
		$request = $this->get('request');
		
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				$em->persist($local);
				$em->flush();
				return $this->redirect($this->generateUrl('parc_admin_local'));
			}
		}
		
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesLocalisation');
		$locals=$rpstr->findBy(array(),array('localite' => 'asc','lieudit' => 'asc',));
		
		return $this->render('ParcAdminBundle:Admin:localisation.html.twig', array(
			'name'  => 'Leclerc',
			'form'  => $form->createView(),
			'locals'=> $locals
		));
    }
	
	public function localModifierAction(DonneesLocalisation $local)
    {	
        $em= $this->getDoctrine()->getManager();
        $form = $this->createForm(new DonneesLocalisationType(), $local);
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				$em->persist($local);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', "La localisation a été bien modifié");
				return $this->redirect($this->generateUrl('parc_admin_local'));
			}
		}
		
		return $this->render('ParcAdminBundle:Admin:modifier.html.twig', array(
			'form'  => $form->createView(),
			'titre'	=> 'de la donnée de localisation',
		));
    }
	
	public function localSupprimerAction(DonneesLocalisation $local)
    {	
        $em= $this->getDoctrine()->getManager();
		
		$em->remove($local);
		$em->flush();
		
		//return $this->redirect( $this->generateUrl('sdzblog_accueil'
		return $this->redirect($this->generateUrl('parc_admin_local'));
    }
}