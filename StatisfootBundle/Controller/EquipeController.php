<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* 
*/
class EquipeController extends Controller
{
	public function viewAction($id){
		$equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')->find($id);
		return $this->render('ProjetStatisfootBundle:Equipe:view_equipe.html.twig', array('equipe'=>$equipe));
	}

	public function effectifAction($id){
		$joueurs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')->findJoueurs($id);
		return $this->render('ProjetStatisfootBundle:Equipe:effectif_equipe.html.twig', array('joueurs'=>$joueurs));
	}
}