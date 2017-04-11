<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;

use Projet\StatisfootBundle\Entity\match_equipe;
use Projet\StatisfootBundle\Entity\match_foot;
use Projet\StatisfootBundle\Entity\equipe;
/**
* 
*/
class MatchController extends Controller
{
	
	public function indexAction(){
		//Recuperation de tout les Matchs.
		$matchs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')->findAll();
		
		//Recuperation desequipes qui ont joues le match
		$listeMatch =array();
		foreach ($matchs as $ma) {
			$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($ma->getId());
			
			$ma_eq = array("idMatch"=>$ma->getId(),"heure"=>$ma->getDateMatch(),
				"NomEq1"=>$match_equipe[0]->getEquipe()->getNom(),"Eq1But"=>$match_equipe[0]->getButMarq(),
				"NomEq2"=>$match_equipe[1]->getEquipe()->getNom(),"Eq2But"=>$match_equipe[1]->getButMarq());
			
			array_push($listeMatch, $ma_eq);
		}
 		return $this->render('ProjetStatisfootBundle:Match:index.html.twig',array('listeMatch'=>$listeMatch));
	}

	public function match_footAction($id){
		$match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')->find($id);
		$date = new \Datetime();
		// les autres match de la competition

		$MatchCompet = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')->findMatchCompet($match->getCompetition());
		$autresDeCompet = array();
		foreach ($MatchCompet as  $mcomp) {
			$eq1_2 = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findMatchEquipe($mcomp->getId());
			array_push($autresDeCompet, $eq1_2);
		}
		
		$m = array();
		$eq1eq2 = array();
		//recuperation des equipes
		$adversaires = array(); 
		$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findMatchEquipe($id);

		$faceface =  $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->faceface($match_equipe[0]->getEquipe()->getId(), $match_equipe[1]->getEquipe()->getId());
			
		$copies = $match_equipe;
		
		array_push($m, $match_equipe[0]);
		array_push($m, $match_equipe[1]);

		
		$tabadversaire1 = array();
		$tabadversaire2 = array();
			// les matchs joues par l'equipe 1
			$LesMatchDeEquipe1 = $this->getDoctrine()->getRepository('ProjetStatisfootBundle:match_equipe')->findLesMatchs($match_equipe[0]->getEquipe()->getId());
			foreach ($LesMatchDeEquipe1 as $Mequipes) {	
				 //Ici pour chaque match on recupere son adversaire
				$match_equipe2 = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findAdversaire($Mequipes->getMatch()->getId(), $match_equipe[0]->getEquipe()->getId());

				foreach ($match_equipe2 as $match_eq) {
					
						array_push($tabadversaire1,
						array('IdMatch'=>$match_eq->getMatch()->getId(),
							'NomEq1'=>$match_equipe[0]->getEquipe()->getNom(),
							'Eq1But'=>$match_eq->getButMarq(),
							'Eq2But'=>$match_eq->getButEnc(),
							'NomEq2'=>$match_eq->getEquipe()->getNom()));
				}

			}
			// les matchs de l'equipe 2
			$LesMatchDeEquipe2 = $this->getDoctrine()->getRepository('ProjetStatisfootBundle:match_equipe')->findLesMatchs($match_equipe[1]->getEquipe()->getId());

			foreach ($LesMatchDeEquipe2 as $Mequipes) {	
				 //Ici pour chaque match on recupere son adversaire
				$match_equipe2 = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findAdversaire($Mequipes->getMatch()->getId(), $match_equipe[1]->getEquipe()->getId());
				foreach ($match_equipe2 as $match_eq) {
					
						array_push($tabadversaire2,
						array('IdMatch'=>$match_eq->getMatch()->getId(),
							'NomEq1'=>$match_equipe[1]->getEquipe()->getNom(),
							'Eq1But'=>$match_eq->getButMarq(),
							'Eq2But'=>$match_eq->getButEnc(),
							'NomEq2'=>$match_eq->getEquipe()->getNom()));

				}

			}
			//
		$competition = $match->getCompetition();
			//recuperation de tous les  matchs de la competition
		$matchs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')
		->findMatchCompet($competition->getId());

		$listeMatch = array();

		foreach ($matchs as $ma) {
			$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($ma->getId());
			
			$ma_eq = array("idMatch"=>$ma->getId(),"heure"=>$ma->getDateMatch(),
				"NomEq1"=>$match_equipe[0]->getEquipe()->getNom(),"Eq1But"=>$match_equipe[0]->getButMarq(),
				"NomEq2"=>$match_equipe[1]->getEquipe()->getNom(),"Eq2But"=>$match_equipe[1]->getButMarq());
			
			array_push($listeMatch, $ma_eq);
		}

		//recuperation des equipes engagées dans la competition
		$equipes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findEquipeCompet($competition->getId());

		//recuperation des resultats des matchs de la compétition
		$resultats = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findResultatsCompet($competition->getId());

		$classement = array();	

		foreach ($equipes as $eq) {
			$nbr = 0;
			$points = 0;
			$buts = 0;
			foreach ($resultats as $result) {
				if ($eq['id'] == $result->getEquipe()->getId()) {
					$nbr++;
					$buts = $buts + ($result->getButMarq() - $result->getButEnc());

					//si l'equipe etait vicotrieuse
					if ($result->getButMarq() > $result->getButEnc()) {
						$points+=3;
					}

					//si l'equipe a fait match nulle
					elseif ($result->getButMarq() == $result->getButEnc()) {
						$points+=1;
					}
				}
			}

			array_push($classement, array("idEq"=>$eq['id'],"nomEq"=>$eq['nom'],"nbJour"=>$nbr,"buts"=>$buts,"points"=>$points));

		}

		//tri des equipes par nombre de points
		$tab = array();
		foreach ($classement as $equi) {
			array_push($tab, $equi["points"]);
		}

		array_multisort($tab, SORT_DESC, $classement);

		//recup du classement des meilleurs buteurs 

		$joueurs =  $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')->findJoueurCompet($id);

		$buts =  $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:but')->findButCompet($id);

		$classementButeurs = array();

		foreach ($joueurs as $j) {
			$nbrB = 0;

			foreach ($buts as $b) {
				if ($j['id']==$b->getJoueur()->getId()) {
					$nbrB++;
				}
			}
			if ($nbrB > 0) {
				array_push($classementButeurs, array("idJ"=>$j['id'],"nomJ"=>$j['nom'],"prenomJ"=>$j['prenom'],"nbrM"=>$j['nbrM'],
				"buts"=>$nbrB));
			}
		}

		//tri des joueurs par nombre de buts
		$tab = array();
		foreach ($classementButeurs as $joue) {
			array_push($tab, $joue["buts"]);
		}

		array_multisort($tab, SORT_DESC, $classementButeurs);


		return $this->render('ProjetStatisfootBundle:Match:match.html.twig', array('match'=>$m, 'adversairesEq1'=>$tabadversaire1, 'adversairesEq2'=>$tabadversaire2, 'faceface'=>$faceface, 'classement'=>$classement,'classementButeurs'=>$classementButeurs, 'nomCompet'=>$match->getCompetition()->getNomCompet()));
	}
}