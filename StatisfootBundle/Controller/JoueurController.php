<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* 
*/
class JoueurController extends Controller
{
	public function viewAction($id){

		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($id);

		$competition = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:competition')->findAll();

		$stat = array();

		foreach ($competition as $compet) {
			$nbDuel = 0;
			$nbInter = 0;
			$nbRecup = 0;
			$nbArret = 0;
			$nbCentre = 0;
			$nbTacle = 0;
			$nbCJ = 0;
			$nbCR = 0;
			$stat_match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')
			->findStat($id,$compet->getId());

			//recuperation des performances du joueur pour chaque joueur
			foreach ($stat_match as $match) {
				$nbDuel +=$match->getNbDuelGagne();
				$nbInter +=$match->getNbBalleInter();
				$nbRecup +=$match->getNbBalleRecup();
				$nbArret +=$match->getNbBalleArret();
				$nbCentre +=$match->getNbCentre();
				$nbTacle +=$match->getNbTacle(); 
				$nbCJ +=$match->getCartonJaune();

				if ($match->getCartonRouge()) {
					$nbCR++;
				}
			}


			$buts = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:but')
			->findBut_compet($id,$compet->getId());

			$passes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:passe_decisive')
			->findPasse_compet($id,$compet->getId());

			//but marqué par le joueur dans la competion
			$but = count($buts);

			//passes décisives délivrées par le joueur dans la competition
			$pd = count($passes);

			//creation du tableau resultat dans la competition donnée
			$tab = array("nom"=>$compet->getNomCompet(),"but"=>$but, "passe"=>$pd,"duel"=>$nbDuel,"inter"=>$nbInter,
				"recup"=>$nbRecup,"arret"=>$nbArret,"centre"=>$nbCentre,"tacle"=>$nbTacle,"cartonJ"=>$nbCJ,"cartonR"=>$nbCR);

			array_push($stat, $tab);
		}

		$equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')->findEquipe($id);

		$coequipiers = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findCoequipiers($id, $equipe[0]->getEquipe()->getId());

		$lesEquipes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')->findLesEquipes($id);

		return $this->render('ProjetStatisfootBundle:Joueur:view_joueur.html.twig', array('joueur'=>$joueur,
			'stat'=>$stat, 'coequipiers'=>$coequipiers,'lesEquipes'=>$lesEquipes));
	}
}