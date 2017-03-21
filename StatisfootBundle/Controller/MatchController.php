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
			//echo $ma->getId();
		$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findMatchEquipe($ma->getId());
			//echo $match_equipe.getMa.getId();
		//echo count($match_equipe);
		//echo $match_equipe[0]->getMatch()->getLieu();
		array_push($listeMatch, $match_equipe);
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
		//les equipes qui ont joues le match.

		//$equipes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')->findBy(array('match'=>$id));
		return $this->render('ProjetStatisfootBundle:Match:match.html.twig', array('match'=>$match, 'infodate'=>$infodate));
	}
}