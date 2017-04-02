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
		// teste si le matcha a ete deja jouer ou à venir.
		if($match->getdateMatch() < $date){
			$infodate = "Match termine";
		}
		if($match->getdateMatch() == $date){
			$infodate = "Match en cours";
		}
		if($match->getdateMatch() > $date){
			$infodate = "Match à venir";
		}
		//Pour chaque equipe on recupere tout qu'il a joue

		//recuperation des equipes
		$adversaires = array(); 
		$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findMatchEquipe($id);
		$copies = $match_equipe;
		foreach ($match_equipe as $equipes) {
			// les matchs joues par l'equipe
			$LesMatchDeEquipe = $this->getDoctrine()->getRepository('ProjetStatisfootBundle:match_equipe')->findLesMatchs($equipes->getEquipe()->getId());

			foreach ($LesMatchDeEquipe as $Mequipes) {
				
				/*
				 *Ici pour chaque match on recupere son adversaire
				 *
				 */
				$match_equipe2 = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findAdversaire($Mequipes->getMatch()->getId(), $equipes->getEquipe()->getId());
				foreach ($match_equipe2 as $match_eq) {
				array_push($adversaires,
				array('IdMatch'=>$match_eq->getMatch()->getId(),
					'NomEq1'=>$equipes->getEquipe()->getNom(),
					'Eq1But'=>$match_eq->getButMarq(),
					'Eq2But'=>$match_eq->getButEnc(),
					'NomEq2'=>$match_eq->getEquipe()->getNom()));
				}
			}

		}
		
		return $this->render('ProjetStatisfootBundle:Match:match.html.twig', array('match'=>$match, 'infodate'=>$infodate,'adversaires'=>$adversaires));
	}
}