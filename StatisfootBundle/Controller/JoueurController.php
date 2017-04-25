<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Projet\StatisfootBundle\Entity\joueur;
use Projet\StatisfootBundle\Entity\joueur_equipe;
use Projet\StatisfootBundle\Form\joueurType;

/**
* 
*/
class JoueurController extends Controller
{
	public function viewAction($id){

		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($id);

		$equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findEquipe($id);

		$competition = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->findCompetEquipe($equipe[0]->getEquipe()->getId());

		$stat = array();

		foreach ($competition as $compet){
			$nbDuel = 0;
			$nbInter = 0;
			$nbRecup = 0;
			$nbArret = 0;
			$nbCentre = 0;
			$nbTacle = 0;
			$nbCJ = 0;
			$nbCR = 0;
			$stat_match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')
			->findStat($id,$compet['id']);

			//recuperation des performances du joueur pour chaque joueur
			foreach ($stat_match as $match) {
				$nbDuel +=$match->getNbDuelGagne();
				$nbInter +=$match->getNbBalleInter();
				$nbRecup +=$match->getNbBalleRecup();
				$nbArret +=$match->getNbBalleArret();
				$nbCentre +=$match->getNbCentre();
				$nbTacle +=$match->getNbTacle(); 
				$nbCJ +=$match->getCartonJaune();

				if ($match->getCartonRouge()){
					$nbCR++;
				}
			}


			$buts = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:but')
			->findBut_compet($id,$compet['id']);

			$passes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:passe_decisive')
			->findPasse_compet($id,$compet['id']);

			//but marqué par le joueur dans la competion
			$but = count($buts);

			//passes décisives délivrées par le joueur dans la competition
			$pd = count($passes);

			//creation du tableau resultat dans la competition donnée
			$tab = array("id"=>$compet['id'],"nom"=>$compet['nom'],"but"=>$but, "passe"=>$pd,"duel"=>$nbDuel,"inter"=>$nbInter,
				"recup"=>$nbRecup,"arret"=>$nbArret,"centre"=>$nbCentre,"tacle"=>$nbTacle,"cartonJ"=>$nbCJ,"cartonR"=>$nbCR);

			array_push($stat, $tab);
		}

		$coequipiers = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findCoequipiers($id, $equipe[0]->getEquipe()->getId());

		$lesEquipes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findLesEquipes($id);

		return $this->render('ProjetStatisfootBundle:Joueur:view_joueur.html.twig', array('joueur'=>$joueur,
			'stat'=>$stat, 'coequipiers'=>$coequipiers,'lesEquipes'=>$lesEquipes));
	}

	public function manage_joueurAction($id){
		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($id);

		$equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findEquipe($id);

		$competition = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->findCompetEquipe($equipe[0]->getEquipe()->getId());

		$stat = array();

		foreach ($competition as $compet){
			$nbDuel = 0;
			$nbInter = 0;
			$nbRecup = 0;
			$nbArret = 0;
			$nbCentre = 0;
			$nbTacle = 0;
			$nbCJ = 0;
			$nbCR = 0;
			$stat_match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')
			->findStat($id,$compet['id']);

			//recuperation des performances du joueur pour chaque joueur
			foreach ($stat_match as $match) {
				$nbDuel +=$match->getNbDuelGagne();
				$nbInter +=$match->getNbBalleInter();
				$nbRecup +=$match->getNbBalleRecup();
				$nbArret +=$match->getNbBalleArret();
				$nbCentre +=$match->getNbCentre();
				$nbTacle +=$match->getNbTacle(); 
				$nbCJ +=$match->getCartonJaune();

				if ($match->getCartonRouge()){
					$nbCR++;
				}
			}


			$buts = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:but')
			->findBut_compet($id,$compet['id']);

			$passes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:passe_decisive')
			->findPasse_compet($id,$compet['id']);

			//but marqué par le joueur dans la competion
			$but = count($buts);

			//passes décisives délivrées par le joueur dans la competition
			$pd = count($passes);

			//creation du tableau resultat dans la competition donnée
			$tab = array("id"=>$compet['id'],"nom"=>$compet['nom'],"but"=>$but, "passe"=>$pd,"duel"=>$nbDuel,"inter"=>$nbInter,
				"recup"=>$nbRecup,"arret"=>$nbArret,"centre"=>$nbCentre,"tacle"=>$nbTacle,"cartonJ"=>$nbCJ,"cartonR"=>$nbCR);

			array_push($stat, $tab);
		}

		$coequipiers = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findCoequipiers($id, $equipe[0]->getEquipe()->getId());

		$lesEquipes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findLesEquipes($id);

		return $this->render('ProjetStatisfootBundle:Joueur:manage_joueur.html.twig', array('joueur'=>$joueur,
			'stat'=>$stat, 'coequipiers'=>$coequipiers,'lesEquipes'=>$lesEquipes));
	}

	public function manage_addAction(Request $request){
		$joueur = new joueur();

		$form   = $this->get('form.factory')->create(joueurType::class, $joueur);

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

			//on recupere l'equipe grace à la session
			$id_equipe = $request->getSession()->get('id_equipe');
			$equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')
			->find($id_equipe);

			
			$joueur_equipe = new joueur_equipe();
			$joueur_equipe->setJoueur($joueur);
			$joueur_equipe->setEquipe($equipe);

		    $em = $this->getDoctrine()->getManager();

		    $em->persist($joueur);
		    $em->persist($joueur_equipe);

		    $em->flush();

		    $request->getSession()->getFlashBag()->add('notice', 'Joueur bien enregistrée.');

		    return $this->redirectToRoute('statisfoot_manage_joueur', array('id' => $joueur->getId()));
		}

		    return $this->render('ProjetStatisfootBundle:Joueur:add.html.twig', array(
		      'form' => $form->createView(),));
	}
}