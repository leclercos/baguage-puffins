<?php
namespace Parc\PuffinsBagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Parc\PuffinsBagBundle\Entity\DonneesPrincipales;
use Parc\PuffinsBagBundle\Entity\DonneesLocalisation;
use Parc\PuffinsBagBundle\Entity\DonneesCRBPO;
use Parc\PuffinsBagBundle\Entity\DonneesComplementaires;
use Parc\PuffinsBagBundle\Entity\DonneesPNPC;
use Parc\PuffinsBagBundle\Entity\AutresMesures;
use Parc\PuffinsBagBundle\Entity\Cartouche;
use Parc\PuffinsBagBundle\Entity\ImportDonneesCSV;
use Parc\PuffinsBagBundle\Form\DonneesPrincipalesType;
use Parc\PuffinsBagBundle\Form\ModifierDonneesType;
use Parc\PuffinsBagBundle\Form\ImportDonneesCSVType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Response;

use Parc\AdminBundle\Form\NewsType;
use Parc\AdminBundle\Form\DocumentType;
use Parc\AdminBundle\Entity\News;
use Parc\AdminBundle\Entity\Document;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\HelperSetInterface;
use Symfony\Component\Console\Helper\Helper;
//use Symfony\Component\Console\Helper;
//use Symfony\Component\Console\Command\Command;
//use Symfony\Component\Console\Command;
//use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PuffinsBagController extends Controller
{
    public function indexAction()
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
				return $this->redirect($this->generateUrl('parc_puffins_bag_accueil'));
			}
		}
		
		$rpstr= $em->getRepository('ParcAdminBundle:News');
		$all_news=$rpstr->findBy(array(),array('id' => 'desc'),10,0);
		//$all_news=$rpstr->findActifsNews();
		 
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:index.html.twig', array(
			'form'  => $form->createView(),
			'all_news'=> $all_news
		));
    }
	
	public function listAction($colonne, $order, $page)
    {	
        $form = $this->createFormBuilder()->getForm();
		
		$em= $this->getDoctrine()->getManager();
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales');
		$liste_cplt=$rpstr->getPuffinsBy(50, $colonne, $order, $page);
		//$liste_cplt=$rpstr->getPuffins(50,$page);
		$total=count($liste_cplt);
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:liste.html.twig', array(
			'puffins' => $liste_cplt,
			'page' => $page,
			'colonne' => $colonne,
			'order' => $order,
			'nombrePage' => ceil($total/50),
			'total' => $total,
			'form' => $form,
		));
    }
	
	public function listByAction($colonne, $order, $page)
    {	
        $form = $this->createFormBuilder()->getForm();
		
		$em= $this->getDoctrine()->getManager();
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales');
		$liste_cplt=$rpstr->getPuffinsBy(50, $colonne, $order, $page);
		$total=count($liste_cplt);
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:liste.html.twig', array(
			'puffins' => $liste_cplt,
			'page' => $page,
			'nombrePage' => ceil($total/50),
			'total' => $total,
			'form' => $form,
		));
    }
	
	/**
	* @Method("POST")
	*/
	public function voirAction($id, $page)
    {
        $em= $this->getDoctrine()->getManager();
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales');
		$puffin=$rpstr->getPuffin($id);
		
		$deleteForm = $this->createDeleteForm($id);
		
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:fiche.html.twig', array(
			'puffin' => $puffin[0],
			'delete_form' => $deleteForm->createView(),
			'page' => $page,
		));
    }
	
	/**
	* @Secure(roles="ROLE_COLLAB")
	*/
	public function ajouterAction()
    {
		$em = $this->getDoctrine()->getManager();
		
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesLocalisation');
		$rpstr1= $em->getRepository('ParcPuffinsBagBundle:BagueurBG');
		$rpstr2= $em->getRepository('ParcPuffinsBagBundle:Colonie');
		
		$securityContext = $this->container->get('security.context');
        
		$puffin  = new DonneesPrincipales();		
		$form = $this->createForm(new DonneesPrincipalesType($securityContext), $puffin);
       
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				$lieudit=$puffin->getLieudit();
				$puffin->setDonneesLocalisation($lieudit);
				$puffin->setLieudit($lieudit->getLieudit());
				
				/* if(($donneesLocal=$rpstr->getLocalisation($lieuditId))) {
					$puffin->setDonneesLocalisation($donneesLocal);
					$puffin->setLieudit($donneesLocal->getLieudit());
				}else {
					$puffin->setLieudit('Inconnu');
				} */
				
				$bg = $puffin->getBg(); // Objet BagueurBG
				$puffin->setBg($bg->getNomCRBPO());
				
				$colonie = $puffin->getColonie(); // Objet Colonie
				$puffin->setColonie($colonie->getColonie());
				
				$condRepr = $puffin->getCondRepr(); // Objet Conditionreprise
				$condRepr !== null ? $puffin->setCondRepr($condRepr->getValeur()) : '' ;
				
				$circRepr = $puffin->getCircRepr(); // Objet CirconstanceReprise
				$circRepr !== null ? $puffin->setCircRepr($circRepr->getValeur()) : '' ;
				
				// Cartouche 
				$cartouche =  new Cartouche();
				$cartouche->setUserCrea($this->getUser()->getNom());			
				$puffin->setCartouche($cartouche);
				
				$em->persist($puffin);
				
				if(($donneesPNPC=$puffin->getDonneesPNPC()) != null) 
					$em->persist($donneesPNPC);
				if(($mesures=$puffin->getAutresMesures()) != null)
					$em->persist($mesures);
					
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', 'Votre enregistrement a été bien ajouté');
				if($puffin->getSauvegarder())
				{
					$puffin_new = new DonneesPrincipales();
					
					$puffin_new->setLieudit($lieudit);					
					$puffin_new->setBg($bg);
					$puffin_new->setColonie($colonie);				
					
					$puffin_new->setSecteur($puffin->getSecteur());
					$puffin_new->setDate($puffin->getDate());
					
					$puffin_new->setSauvegarder(true);
					
					//$this->get('session')->getFlashBag()->add('info', 'Puffin bien enregistré');
					$form2 = $this->createForm(new DonneesPrincipalesType($securityContext), $puffin_new);
					return $this->render('ParcPuffinsBagBundle:PuffinsBag:ajouter.html.twig', array(
						'puffin' => $puffin_new,
						'form'   => $form2->createView(),
					));
				}else{
					return $this->redirect($this->generateUrl('parc_puffins_bag_liste'));
				}
			}
			$this->get('session')->getFlashBag()->add('error', " Enregistrement non ajouté!! Verifiez vos valeurs");
		}
		
        return $this->render('ParcPuffinsBagBundle:PuffinsBag:ajouter.html.twig', array(
            'puffin' => $puffin,
            'form'   => $form->createView(),
        ));
    }
	
	/**
	* @Secure(roles="ROLE_COLLAB")
	*/
	public function modifierAction(DonneesPrincipales $puffin)
    {        
		$em = $this->getDoctrine()->getManager();
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesLocalisation');
		$rpstr1= $em->getRepository('ParcPuffinsBagBundle:BagueurBG');
		$rpstr2= $em->getRepository('ParcPuffinsBagBundle:Colonie');
		$rpstr3= $em->getRepository('ParcPuffinsBagBundle:ConditionReprise');
		$rpstr4= $em->getRepository('ParcPuffinsBagBundle:CirconstanceReprise');		
		
		$securityContext = $this->container->get('security.context');
		
		$lieudit = $rpstr->getLocalisationByLieudit($puffin->getLieudit());
		$puffin->setLieudit($lieudit);
		
		$bg = $puffin->getBg();
		$puffin->setBg($rpstr1->findOneByNomCRBPO($bg));
		
		$colonie = $puffin->getColonie();
		$puffin->setColonie($rpstr2->findOneBy(array('lieudit' => $lieudit->getId(),
			'colonie' => $colonie), null, null, null));
		
		if($puffin->getAction() !== 'B'){
			$puffin->setCondRepr($rpstr3->findOneByValeur($puffin->getCondRepr()));
			$puffin->setCircRepr($rpstr4->findOneByValeur($puffin->getCircRepr()));
		}
		
        $form = $this->createForm(new ModifierDonneesType($securityContext), $puffin);
		$request = $this->get('request');
		$id=$puffin->getId();
		if ($request->getMethod() == 'POST') 
		{
			$form->bind($request);
			if ($form->isValid()) 
			{
				//$bgId = $puffin->getBg();
				$bg = $puffin->getBg(); // Objet BagueurBG
				$puffin->setBg($bg->getNomCRBPO());
				
				$colonie = $puffin->getColonie(); // Objet Colonie
				$puffin->setColonie($colonie->getColonie());
				
				$lieuditId=$puffin->getLieudit();				
				if(($donneesLocal=$rpstr->getLocalisation($lieuditId))) {
					$puffin->setDonneesLocalisation($donneesLocal);
					$puffin->setLieudit($donneesLocal->getLieudit());
				}else {
					$puffin->setLieudit('Inconnu');
				}
				if($puffin->getAction() !== 'B'){
					$condRepr = $puffin->getCondRepr(); // Objet Conditionreprise
					$puffin->setCondRepr($condRepr->getValeur());
					$circRepr = $puffin->getCircRepr(); // Objet CirconstanceReprise
					$puffin->setCircRepr($circRepr->getValeur());
				}
				
				//cartouche
				$cartouche = $puffin->getCartouche();
				$cartouche->setUserMaj($this->getUser()->getNom());	
				$cartouche->setDateMaj(new \DateTime());	
				$puffin->setCartouche($cartouche);
				
				$em->persist($puffin);
				
				$donneesPNPC=$puffin->getDonneesPNPC();
				
				if( $donneesPNPC != null)
					$em->persist($donneesPNPC); 
				if(($mesures=$puffin->getAutresMesures()) != null)
					$em->persist($mesures);
	
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', "Enregistrement N°".$id." a été bien modifié");
				return $this->redirect($this->generateUrl('parc_puffins_bag_liste'));
			}
			//return $this->redirect($this->generateUrl('parc_puffins_bag_accueil'));
		}
		//
        return $this->render('ParcPuffinsBagBundle:PuffinsBag:modifier.html.twig', array(
            'puffin' => $puffin,
            'form'   => $form->createView(),
        ));
    }
	
	/**
	* @Secure(roles="ROLE_ADMIN")
	*/
	public function supprimerAction(DonneesPrincipales $puffin)
    {
        $em= $this->getDoctrine()->getManager();
		
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
			
			$id=$puffin->getId();
			$em->remove($puffin);
			$em->flush();
			$this->get('session')->getFlashBag()->add('warning', "L'enregistrement N°$id a été bien supprimé");

			// Puis on redirige vers l'accueil
			return $this->redirect($this->generateUrl('parc_puffins_bag_liste'));
		}
		return $this->redirect($this->generateUrl('parc_puffins_bag_liste'));
    }
	
	/**
	* @Secure(roles="ROLE_COLLAB")
	*/
	public function importerAction()
    {	
		ini_set('memory_limit', '512M'); // memoire alloué pour l'import des données

		$em= $this->getDoctrine()->getManager();
		$msgbag = $this->get('session')->getFlashBag();
        
		$fichierCSV  = new ImportDonneesCSV();
        $form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
       
		$request = $this->get('request');
		//$form->handleRequest($request);
		if ($request->getMethod() == 'POST') 
		{   
			$form->bind($request);
			if ($form->isValid()) {
			
				$path= __DIR__.'/../../../../web/Resources';				
				$fichierCSV->getFichierCSV()->move($path, 'puffin.csv');				
				$handle = fopen($path.'//puffin.csv', 'r');
				
				// Cartouche 
				$cartouche =  new Cartouche();
				$cartouche->setUserCrea($this->getUser()->getNom());
				//$cartouche->setUserCrea('Super');
				$cartouche->setDateMaj(new \DateTime());
				
				$keys1=array_filter(fgetcsv($handle,1000,';'));				
				$keys_pnpc=array('primaire','secondaire','rectrice','couv','coud','rg','pl','pr','asg');
				$keys_autrem=array('champ1','champ2','champ3','champ4','mesure1','mesure2','mesure3','mesure4');
				
				$keys=array_flip(array_change_key_case(array_flip($keys1),CASE_LOWER));
				// pour verifier s'il y a des donnes pncp ou autres...
				$pnpc=array_intersect($keys, $keys_pnpc); // les cles de pnpc
				$autrem=array_intersect($keys, $keys_autrem); // les cles d'autres champs				
				$has_pnpc=false;
				$has_autrem=false;
				if (count(array_unique($pnpc)) > 0) $has_pnpc=true;
				if (count(array_unique($autrem)) > 0) $has_autrem=true;				
				
				$nbr=0; $err=0; $errors=array();
				while (($data = fgetcsv($handle, 1000,';')) !== FALSE and  count(array_unique($data))>1)
				{	
					$length=count($keys);
					$data2=array_slice($data,0,$length); // limiter les colonnes vides
					$data1=array();
					foreach($data2 as $value){
						//$data1[]=htmlentities($value, ENT_SUBSTITUTE | ENT_HTML5, "utf-8",true);
						$data1[]=htmlspecialchars ($value, ENT_QUOTES|ENT_IGNORE, "UTF-8");
					}
					$args=array_combine($keys,$data1);
					
					$puffin = new DonneesPrincipales();					
					$puffin->construct($args,$has_pnpc,$has_autrem); // construction des donnees
					
					// Donnees de localisation
					$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesLocalisation');							
					if(array_key_exists('lieudit',$args)) $lieudit=$args['lieudit'];
					else $lieudit="Inconnu";
					
					if(($donneesLocal=$rpstr->getLocalisationByLieudit($lieudit))){ 
						$puffin->setDonneesLocalisation($donneesLocal);									
						$puffin->setCartouche($cartouche);
						
						// Validation des donnees
						$validator = $this->get('validator');
						$errorList = $validator->validate($puffin, array('importer'));
						if (count($errorList) == 0) {						 
							$em->persist($puffin);
							
							if(($donneesPNPC=$puffin->getDonneesPNPC()) != null)
								$em->persist($donneesPNPC);
							if(($mesures=$puffin->getAutresMesures()) != null)
								$em->persist($mesures);
								
							$nbr++;
						} else{  							
							foreach($errorList as $errorV){
								$msgbag->add('error', "Erreur Ligne ".($nbr+2).": Colonne '".strtoupper($errorV->getPropertyPath())."' - "
								.$errorV->getMessage() );							
							}
							$form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
							return $this->render('ParcPuffinsBagBundle:PuffinsBag:importer.html.twig', array(
								'form'   => $form->createView(),
							));
						}
					}else {						
						$msgbag->add('error', "Erreur!! Ligne ".($nbr+2).": Le Lieudit ' ".$lieudit." ' n'existe pas! Verifiez et recommencez");
						$errors[$err]=$lieudit;
						$err++;
						//$fichierCSV  = new ImportDonneesCSV();
						$form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
						return $this->render('ParcPuffinsBagBundle:PuffinsBag:importer.html.twig', array(
							'form'   => $form->createView(),
						)); 
					}			
				}
				fclose($handle);
				
				$em->flush();
				
				$last=$puffin->getId();
				$first=$last-$nbr;
				$msgbag->add('info', $nbr."Enregistrements ont étés ajoutés à la base N°".$first." à N°".$last);
				
				return $this->redirect($this->generateUrl('parc_puffins_bag_liste'));
			}
		}
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:importer.html.twig', array(
            'form'   => $form->createView(),
		));
    }
	
	/**
	* @Secure(roles="ROLE_COLLAB")
	*/
	public function exporterAction()
    {
		ini_set('memory_limit', '1024M');
		
		$em= $this->getDoctrine()->getManager();
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales');
		$liste_puffins=$rpstr->getAllPuffins();
		
        $handle = fopen('php://memory', 'r+');
        $header = array_keys(array_change_key_case($liste_puffins[0],CASE_UPPER));
		
		fputcsv($handle, $header, ";");
		
		$liste_puffins_object = new \ArrayObject($liste_puffins);
		$liste_puffins_iterator = $liste_puffins_object->getIterator();
		$i=0;
		while($liste_puffins_iterator->valid() && $i<40000) {
			$puffin = $liste_puffins_iterator->current();
			$value1=$puffin['date'];
			$puffin['date']=$value1->format('d-m-Y');
			$value2=$puffin['heure'];
			$puffin['heure']=$value2->format('H:i:s');
			//$puffin['heure']= str_replace(':','H',$value2);
			fputcsv($handle, $puffin, ";");
			$liste_puffins_iterator->next();
			$i++;
		}
		
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        $response= new Response($content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="puffins.csv"'
        ));
		
		return $response;
    }
	
	/**
	* @Secure(roles="ROLE_COLLAB")
	*/
	public function exporterReqAction($champs,$valeurs,$crbpo)
    {
		ini_set('memory_limit', '1024M');
		
		$em= $this->getDoctrine()->getManager();
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales');
		
		$champs_arr=explode('.',$champs);
		$valeurs_arr=explode('.',$valeurs);
		$liste_puffins=$rpstr->findAllPuffinsBy($champs_arr, $valeurs_arr,$crbpo === 1);
		
        $handle = fopen('php://memory', 'r+');
        $header = array_keys(array_change_key_case($liste_puffins[0],CASE_UPPER));
		
		fputcsv($handle, $header, ";");
		
		$liste_puffins_object = new \ArrayObject($liste_puffins);
		$liste_puffins_iterator = $liste_puffins_object->getIterator();
		
		$i=0;
		while($liste_puffins_iterator->valid() && $i<40000) {
			$puffin = $liste_puffins_iterator->current();
			$value1=$puffin['date'];
			$puffin['date']=$value1->format('d-m-Y');
			$value2=$puffin['heure'];
			//$puffin['heure']=$value2->format('H:i:s');
			fputcsv($handle, $puffin, ";");
			$liste_puffins_iterator->next();
			$i++;
		}
       
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
        
        $response= new Response($content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="puffins.csv"'
        ));
		
		return $response;
    }
	
	/**
	* @Secure(roles="ROLE_USER")
	*/
	public function requetesAction()
    {
		$em= $this->getDoctrine()->getManager();
		
        $form = $this->createFormBuilder()
					->add('lieudit','text', array('label' => 'Lieudit : ','required'=>false,))
					->getForm();
		
		$request = $this->get('request');
		$form->handleRequest($request);
		
		if ($form->isValid()) 
		{	
			$form=$request->get('form');
			$champs=array();
			$valeurs=array();			
			
			$i=1;
			if($form['lieudit'] != null){
				$champs[]='lieudit'; 
				$valeurs[]=$form['lieudit'];
			}			
			while( ($valeur=$request->get('champ'.$i))!= null){
				$champs[]=$request->get('new_champ_'.$i);
				$valeurs[]=$valeur;
				$i++;
			}
			if(!empty($valeurs)){
				return $this->redirect($this->generateUrl('parc_puffins_bag_resultats',array(
					'champs'  => implode('.',$champs),
					'valeurs' => implode('.',$valeurs),
				)));
			}
			else{
				$form = $this->createFormBuilder()
					->add('lieudit','text', array('required'=>false,))
					->getForm();
			}
		}
		
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:requetes.html.twig', array(
			'form'   => $form->createView(),
		));
    }
	
	public function resultatsReqAction($champs, $valeurs, $colonne, $order, $page)
    {
		$champs_arr=explode('.',$champs);
		$valeurs_arr=explode('.',$valeurs);
		
		$em= $this->getDoctrine()->getManager();
		$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales');
		
		$puffins=$rpstr->findPuffinsBy($champs_arr, $valeurs_arr, 50, $colonne, $order, $page);
		
		$nombreTotal=count($puffins);
		
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:resultats.html.twig', array(
			'puffins' 	=> $puffins,
			'champs' 	=> $champs,
			'valeurs'	=> $valeurs,
			'page' 		=> $page,
			'nombrePage'=> ceil($nombreTotal/50),
			'nombreTotal'=>$nombreTotal,			
			'colonne' => $colonne,
			'order' => $order,
		));
    }
	
	private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
	
	/**
	* @Secure(roles="ROLE_COLLAB")
	*/
	public function documentsAction()
    {	
        $em= $this->getDoctrine()->getManager();
		$document = new Document();
        $form = $this->createForm(new DocumentType(), $document); 
		
		$request = $this->get('request');		
		if ($request->getMethod() == 'POST'){
			$form->bind($request);
			if ($form->isValid()){
				$user = $this->getUser();
				$document->setAuteur($user->getNom());
				
				$em->persist($document);
				$em->flush();
				
				$this->get('session')->getFlashBag()->add('info', 'Le document a été bien ajouté');
				return $this->redirect($this->generateUrl('parc_puffins_bag_documents'));
			}
		}
		
		$rpstr = $em->getRepository('ParcAdminBundle:Document');
		$documents = $rpstr->findAll();
		 
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:documents.html.twig', array(
			'form'  => $form->createView(),
			'documents'=> $documents
		));
    }
	/**
	* @Secure(roles="ROLE_COLLAB")
	*/
	public function importerModifAction()
    {	
		ini_set('memory_limit', '512M'); // memoire alloué pour l'import des données

		$em= $this->getDoctrine()->getManager();
		
		$msgbag = $this->get('session')->getFlashBag();
        
		$fichierCSV  = new ImportDonneesCSV();
        $form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
       
		$request = $this->get('request');
		//$form->handleRequest($request);
		if ($request->getMethod() == 'POST') 
		{   
			$form->bind($request);
			if ($form->isValid()) {
			
				$path= __DIR__.'/../../../../web/Resources';				
				$fichierCSV->getFichierCSV()->move($path, 'puffin.csv');				
				$handle = fopen($path.'//puffin.csv', 'r');
				
				$keys1=array_filter(fgetcsv($handle,1000,';'));				
				$keys_pnpc=array('primaire','secondaire','rectrice','couv','coud','rg','pl','pr','asg');
				$keys_autrem=array('champ1','champ2','champ3','champ4','mesure1','mesure2','mesure3','mesure4');
				
				// pour verifier s'il y a des donnes pncp ou autres...
				$pnpc=array_intersect($keys1, $keys_pnpc); // les cles de pnpc
				$autrem=array_intersect($keys1, $keys_autrem); // les cles d'autres champs				
				$has_pnpc=false;
				$has_autrem=false;
				if (count(array_unique($pnpc)) > 1) $has_pnpc=true;
				if (count(array_unique($autrem)) > 1) $has_autrem=true;
				
				$keys=array_flip(array_change_key_case(array_flip($keys1),CASE_LOWER));
				
				$nbr=0; $err=0; $errors=array();
				if($keys[0] == 'id'){
					$rpstr= $em->getRepository('ParcPuffinsBagBundle:DonneesPrincipales');
					$rpstr1= $em->getRepository('ParcPuffinsBagBundle:DonneesLocalisation');
					$rpstr2= $em->getRepository('ParcPuffinsBagBundle:Cartouche');
					
					while (($data = fgetcsv($handle, 1000,';')) !== FALSE and  count(array_unique($data))>1)
					{	
						$length=count($keys);
						$data2=array_slice($data,0,$length); // limiter les colonnes vides
						
						// Gestion des carèctères spéciaux
						$data1=array();
						foreach($data2 as $value){
							//$data1[]=htmlentities($value, ENT_SUBSTITUTE | ENT_HTML5, "utf-8",true);
							$data1[]=htmlspecialchars ($value, ENT_QUOTES|ENT_IGNORE, "UTF-8");
						}
						// nouveau tableau champ/valeur
						$args=array_combine($keys,$data1);
						
						$id1 = $args['id'];
						$id =(int)$args['id']; // valeur entière
						//$puffin = $rpstr->findById($id);
						if($puffinModif = $rpstr->find($id)){	
						
							//cartouche		
							$cartouche;
							if($cartouche = $puffinModif->getCartouche()){
								$cartouche->setUserMaj($this->getUser()->getNom());
								$cartouche->setDateMaj(new \DateTime());
							}else {
								$cartouche = new Cartouche();
								$cartouche->setUserCrea($this->getUser()->getNom());	
							}
							$puffinModif->setCartouche($cartouche);
							
							// nouvelles données puffins
							$puffinModif->construct($args,$has_pnpc,$has_autrem); // construction des donnees						
							
							// Donnees de localisation										
							if(array_key_exists('lieudit',$args)) $lieudit=$args['lieudit'];
							else $lieudit="Inconnu";
							
							if(($donneesLocal=$rpstr1->getLocalisationByLieudit($lieudit))){ 
								$puffinModif->setDonneesLocalisation($donneesLocal);	
								
								// Validation des donnees
								$validator = $this->get('validator');
								$errorList = $validator->validate($puffinModif, array('importer'));
								if (count($errorList) == 0) {						 
									$em->persist($puffinModif);
									
									if(($donneesPNPC=$puffinModif->getDonneesPNPC()) != null)
										$em->persist($donneesPNPC);
									if(($mesures=$puffinModif->getAutresMesures()) != null)
										$em->persist($mesures);
										
									$nbr++;
								} else{  							
									foreach($errorList as $errorV){
										$msgbag->add('error', "Erreur Ligne ".($nbr+2).": Colonne '".strtoupper($errorV->getPropertyPath())."' - "
										.$errorV->getMessage() );							
									}
									$form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
									return $this->render('ParcPuffinsBagBundle:PuffinsBag:importer.html.twig', array(
										'form'   => $form->createView(),
									));
								}
							}else {						
								$msgbag->add('error', "Erreur!! Ligne ".($nbr+2).": Le Lieudit ' ".$lieudit." ' n'existe pas! Verifiez et recommencez");
								$errors[$err]=$lieudit;
								$err++;
								//$fichierCSV  = new ImportDonneesCSV();
								$form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
								return $this->render('ParcPuffinsBagBundle:PuffinsBag:importerModif.html.twig', array(
									'form'   => $form->createView(),
								)); 
							}
						}else{
							$msgbag->add('error', "Erreur!! Ligne ".($nbr+2).": Le puffin n° ".$id1." n'existe pas ou a été déja supprimé!
								\n Verifiez et recommencez");
							$form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
							return $this->render('ParcPuffinsBagBundle:PuffinsBag:importerModif.html.twig', array(
								'form'   => $form->createView(),
							)); 
						}						
					}				
				}else{
					$msgbag->add('error', "Numéro d'identifiant (ID) des puffins à modifier manquant! Erreur!! 
						Veuillez mporter un fichier de Modification valide!");
					$form = $this->createForm(new ImportDonneesCSVType(), $fichierCSV);
					return $this->render('ParcPuffinsBagBundle:PuffinsBag:importerModif.html.twig', array(
						'form'   => $form->createView(),
					)); 
				}	
				fclose($handle);
				
				$em->flush();
				
				$msgbag->add('info', $nbr.' Enregistrements ont étés modifiés avec succès dans la base');
				
				return $this->redirect($this->generateUrl('parc_puffins_bag_liste'));
			}
		}
		return $this->render('ParcPuffinsBagBundle:PuffinsBag:importerModif.html.twig', array(
            'form'   => $form->createView(),
		));
    }
}
