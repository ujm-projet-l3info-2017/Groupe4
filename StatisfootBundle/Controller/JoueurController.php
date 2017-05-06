<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Projet\StatisfootBundle\Entity\joueur;
use Projet\StatisfootBundle\Entity\joueur_equipe;
use Projet\StatisfootBundle\Form\joueurType;
use Projet\StatisfootBundle\Form\joueurModType;

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

	public function manage_joueurAction($id, Request $request){
		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($id);

		$id_equipe = $request->getSession()->get('id_equipe');
		$equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')
		->find($id_equipe);

		$competition = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->findCompetEquipe($equipe->getId());

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
		->findCoequipiers($id, $equipe->getId());

		$lesEquipes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findLesEquipes($id);

		return $this->render('ProjetStatisfootBundle:Joueur:manage_joueur.html.twig', array('joueur'=>$joueur,
			'stat'=>$stat, 'coequipiers'=>$coequipiers,'lesEquipes'=>$lesEquipes));
	}

	public function joueur_addAction(Request $request){
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

	public function joueur_modAction($id, Request $request){
		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($id);

		if(null==$joueur){
			throw new NotFoundHttpException("Le joueur d'id : ".$id." n'existe pas");
		}

		$form   = $this->get('form.factory')->create(joueurModType::class, $joueur);

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->flush($joueur);

			$request->getSession()->getFlashBag()->add('notice', 'Joueur a bien été modifié.');

		    return $this->redirectToRoute('statisfoot_manage_joueur', array('id' => $joueur->getId()));
		}

		return $this->render('ProjetStatisfootBundle:Joueur:mod.html.twig', array(
		      'joueur'=> $joueur,'form' => $form->createView(),));
	}

	public function joueur_supAction($id, Request $request){
		$contrat = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findContrat($id);

		if(null==$joueur){
			throw new NotFoundHttpException("Le joueur d'id : ".$id." n'existe pas");
		}

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$contrat->setDateFin(new \DateTime());
			$em->flush($contrat);
			return $this->redirectToRoute('statisfoot_manage_equipe', 
				array('id'=>$request->getSession()->get('id_man')));
		}

		return $this->redirectToRoute('statisfoot_manage_joueur', array('id' => $id));
	}

	public function joueur_rempAction($idRt, $idRe, Request $request){


			$remplacant = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
			->findJoueurAndEquipe($idRt);

			$remplace = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
			->findJoueurAndEquipe($idRe);

			if ($remplacant[0]->getTitulaire()) {
				$poste = $remplacant[0]->getPoste();
				$remplacant[0]->setPoste($remplace[0]->getPoste());
				$remplace[0]->setPoste($poste);
			} else {
				$remplacant[0]->setTitulaire(true);
				$remplacant[0]->setRemplacant(false);
				$remplacant[0]->setPoste($remplace[0]->getPoste());

				$remplace[0]->setTitulaire(false);
				$remplace[0]->setRemplacant(true);
			}

			$em = $this->getDoctrine()->getManager();
			$em->flush($remplace);
			$em->flush($remplacant);

			return new Response($idRt." et ".$idRe, 200);
		

		// return new Response("Erreur : ce n'est pas une requete POST".$request->get('idRt'), 400);
	}

}