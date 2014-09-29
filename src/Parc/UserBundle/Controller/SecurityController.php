<?php
	// src/Parc/UserBundle/Controller/SecurityController.php;
	namespace Parc\UserBundle\Controller;
	
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\Security\Core\SecurityContext;

	class SecurityController extends Controller
	{
		public function loginAction()
		{
			// Si le visiteur est déjà identifié, on le redirige vers l'accueil
			if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
				return $this->redirect($this->generateUrl('parc_puffins_bag_accueil'));
			}
			
			$request = $this->getRequest();
			$session = $request->getSession();
			
			// On vérifie s'il y a des erreurs d'une précédente soumissiondu formulaire
			if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
				$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
			}
			else {
				$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
				$session->remove(SecurityContext::AUTHENTICATION_ERROR);
			}
			return $this->render('ParcUserBundle:Security:login.html.twig', array(
				// Valeur du précédent nom d'utilisateur entré par l'internaute
				'last_username' => $session->get(SecurityContext::LAST_USERNAME),
				'error' => $error,
			));
		}
	}
?>