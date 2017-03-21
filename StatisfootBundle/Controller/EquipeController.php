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

		//on recupere la liste des match pour l'equipe
		$match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findMatch($id);

		$liste_match = array();
		foreach ($match as $key) {
			//pour chaque match on recupere l'equipe adverse
			$ma = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($key->getMatch()->getId());

			array_push($liste_match, $ma);
		}

		return $this->render('ProjetStatisfootBundle:Equipe:view_equipe.html.twig', array('equipe'=>$equipe,
			'listeMatch'=>$liste_match));
	}

	public function effectifAction($id){
		//recuperation de la liste des joueurs de l'equipe (l'effectif)
		$joueurs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')->findJoueurs($id);
		return $this->render('ProjetStatisfootBundle:Equipe:effectif_equipe.html.twig', array('joueurs'=>$joueurs));
	}
}