<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* 
*/
class CompetitionController extends Controller
{
	public function viewAction($id){
		$competition = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:competition')->find($id);

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

		return $this->render('ProjetStatisfootBundle:Competition:view_compet.html.twig', array('compet'=>$competition,
			'listeMatch'=>$listeMatch, 'classement'=>$classement));
	}	

	//affichage des match d'une compettion par journée 
	public function journeeAction($id,$numJ){
		$competition = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:competition')->find($id);

		//recuperation de tous les  matchs de la journéé concernée
		$matchs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')
		->findMatchCompetJour($id,$numJ);

		$listeMatch = array();

		//recupération des deux equipes du match et resultats du match
		foreach ($matchs as $ma) {
			$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($ma->getId());
			
			$ma_eq = array("idMatch"=>$ma->getId(),"heure"=>$ma->getDateMatch(),
				"NomEq1"=>$match_equipe[0]->getEquipe()->getNom(),"Eq1But"=>$match_equipe[0]->getButMarq(),
				"NomEq2"=>$match_equipe[1]->getEquipe()->getNom(),"Eq2But"=>$match_equipe[1]->getButMarq());
			
			array_push($listeMatch, $ma_eq);
		}

		return $this->render('ProjetStatisfootBundle:Competition:journee_compet.html.twig', array('compet'=>$competition,
			'listeMatch'=>$listeMatch));
	}
}