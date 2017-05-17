<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Projet\StatisfootBundle\Entity\joueur;
use Projet\StatisfootBundle\Entity\joueur_equipe;
use Projet\StatisfootBundle\Entity\but;
use Projet\StatisfootBundle\Entity\passe_decisive;
use Projet\StatisfootBundle\Entity\match_joueur;
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

			$em->flush();

			return new Response($idRt." et ".$idRe, 200);
		

		// return new Response("Erreur : ce n'est pas une requete POST".$request->get('idRt'), 400);
	}

	//changement d'un joueur au cours d'un match
	public function joueur_changAction($idRt, $idRe, $idM, $t, Request $request){

		$em = $this->getDoctrine()->getManager();

		$match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')->find($idM);

		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($idRt);

		$remplacant = new match_joueur();

		$remplacant->setPoste($joueur->getPoste()->getLibellePoste());
		$remplacant->setMinEntre($t);
		$remplacant->setMinSortie(90);
		$remplacant->setNbDuelGagne(0);
		$remplacant->setNbBalleInter(0);
		$remplacant->setNbBalleRecup(0);
		$remplacant->setNbBalleArret(0);
		$remplacant->setNbCentre(0);
		$remplacant->setNbTacle(0);
		$remplacant->setCartonRouge(false);
		$remplacant->setCartonJaune(0);
		$remplacant->setNbTirCadre(0);

		$remplacant->setJoueur($joueur);
		$remplacant->setMatchFoot($match);

		$remplace = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')
		->findMatchJoueur($idM,$idRe);

		$remplace[0]->setMinSortie($t);

		$em->persist($remplacant);

		$em->flush();

		return new Response($idRt.", ".$idRe.", ".$idM." et ".$t, 200);

	}

	public function joueur_butAction($idJ,$idM,$idB,$idA,$t, Request $request){

		$em = $this->getDoctrine()->getManager();

		$but = new but();

		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($idJ);

		$match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')->find($idM);

		$typeBut = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:type_but')->find($idB);

		if ($idA == 0) {
			$typeAction = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:type_action')->find(5);
		}
		else{
			$typeAction = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:type_action')->find($idA);
		}

		//on recupere l'equipe grace à la session
		$id_equipe = $request->getSession()->get('id_equipe');

		$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->findMatchEquipe($idM);

		if ($id_equipe == $match_equipe[0]->getEquipe()->getId()) {

			$match_equipe[0]->setButMarq($match_equipe[0]->getButMarq()+1);
			$match_equipe[1]->setButEnc($match_equipe[1]->getButEnc()+1);	
		}
		else{
			$match_equipe[1]->setButMarq($match_equipe[1]->getButMarq()+1);
			$match_equipe[0]->setButEnc($match_equipe[0]->getButEnc()+1);
		}

		$but->setMinJeu($t);
		$but->setJoueur($joueur);
		$but->setTypeBut($typeBut);
		$but->setTypeAction($typeAction);
		$but->setMatchFoot($match);

		$em->persist($but);
		$em->flush();

		return new Response($idJ.", ".$idM.", ".$idB." et ".$idA, 200);
	}

	public function joueur_passeAction($idJ,$idM,$idP, Request $request){

		$em = $this->getDoctrine()->getManager();

		$passe = new passe_decisive();

		$joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur')->find($idJ);

		$but = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:but')->findDernierButMatch($idM);

		$typePasse = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:type_passe')->find($idP);

		$passe->setBut($but[0]);
		$passe->setJoueur($joueur);
		$passe->setTypePasse($typePasse);

		$em->persist($passe);
		$em->flush();

		return new Response($idJ.", ".$idM." et ".$idP, 200);
	}

	public function joueur_actionAction($idJ,$idM,$idA,$t, Request $request){

		$em = $this->getDoctrine()->getManager();

		$match_joueur = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')
		->findMatchJoueur($idM,$idJ);

		switch ($idA) {
			case 3 :
				$match_joueur[0]->setNbDuelGagne($match_joueur[0]->getNbDuelGagne()+1);
				break;

			case 4 :
				$match_joueur[0]->setNbBalleInter($match_joueur[0]->getNbBalleInter()+1);
				break;

			case 5 :
				$match_joueur[0]->setNbBalleRecup($match_joueur[0]->getNbBalleRecup()+1);
				break;

			case 7 :
				$match_joueur[0]->setNbBalleArret($match_joueur[0]->getNbBalleArret()+1);
				break;

			case 8 :
				$match_joueur[0]->setNbCentre($match_joueur[0]->getNbCentre()+1);
				break;

			case 6 :
				$match_joueur[0]->setNbTacle($match_joueur[0]->getNbTacle()+1);
				break;

			case 9 :
				$match_joueur[0]->setCartonJaune($match_joueur[0]->getCartonJaune()+1);
				if ($match_joueur[0]->getCartonJaune() == 2) {
					$match_joueur[0]->setMinSortie($t);
				}
				break;

			case 10 :
				$match_joueur[0]->setCartonRouge(true);
				$match_joueur[0]->setMinSortie($t);
				break;
			
			default:
				$match_joueur[0]->setNbTirCadre($match_joueur[0]->getNbTirCadre()+1);

				//on recupere l'equipe grace à la session
				$id_equipe = $request->getSession()->get('id_equipe');

				$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
				->findMatchEquipe($idM);

				if ($id_equipe == $match_equipe[0]->getEquipe()->getId()) {

					$match_equipe[0]->setTirCadre($match_equipe[0]->getTirCadre()+1);	
				}
				else{
					$match_equipe[1]->setTirCadre($match_equipe[1]->getTirCadre()+1);
				}
				break;
		}

		$em->flush();

		return new Response($idJ.", ".$idM." et ".$idA, 200);
	}

}