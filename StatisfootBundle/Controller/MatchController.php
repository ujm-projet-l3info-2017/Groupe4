<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;
/**
* 
*/
class MatchController extends Controller
{
	
	public function indexAction(){

		$match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot');
		$listeMatch = $match->findAll();
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