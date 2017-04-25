<?php
// src/Projet/StatisfootBundle/Controller/SecurityController.php;

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    $authenticationUtils = $this->get('security.authentication_utils');
    // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      $username = $authenticationUtils->getLastUsername();
      $utilisateur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:manager')->findOneByUsername($username);
      //$user = $this->get('security.context')->getToken()->getUser();
      //echo $user->getUsername().'ahan';
      return $this->redirect('statisfoot_manage_equipe', array('id'=>$utilisateur->getId()));

    }

    // Le service authentication_utils permet de récupérer le nom d'utilisateur
    // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
    // (mauvais mot de passe par exemple)
    

    return $this->render('ProjetStatisfootBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }
}
