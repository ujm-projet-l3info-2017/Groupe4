<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
* 
*/
class EquipeController extends Controller
{
	public function listequipeAction(){
		$equipes = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')->findAll();

		return $this->render('ProjetStatisfootBundle:Equipe:liste_equipe.html.twig', array('listeEquipe'=>$equipes));
	}

	public function viewAction($id){
		$equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')->find($id);

		//on recupere la liste des match pour l'equipe
		$matchs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->findMatch($id);

		$listeMatch =array();

		foreach ($matchs as $ma) {
			$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($ma->getMatch()->getId());
			
			$ma_eq = array("idMatch"=>$ma->getMatch()->getId(),"heure"=>$ma->getMatch()->getDateMatch(),
				"NomEq1"=>$match_equipe[0]->getEquipe()->getNom(),"Eq1But"=>$match_equipe[0]->getButMarq(),
				"NomEq2"=>$match_equipe[1]->getEquipe()->getNom(),"Eq2But"=>$match_equipe[1]->getButMarq());
			
			array_push($listeMatch, $ma_eq);
		}

		//recuperation de la liste des joueurs
		$joueurs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')->findJoueurs($id);

		return $this->render('ProjetStatisfootBundle:Equipe:view_equipe.html.twig', array('equipe'=>$equipe,
			'listeMatch'=>$listeMatch,'joueurs'=>$joueurs));
	}

	public function clubAction($id){
		$club = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:club')->find($id);

		$listeEquipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')->findEquipes($id);

		return $this->render('ProjetStatisfootBundle:Equipe:club.html.twig', array('listeEquipe'=>$listeEquipe, 'club'=>$club));		
	}


	public function manage_equipeAction($id, Request $request){

		$manager = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:manager')->find($id);
		
		//recuperation de l'equipe
		$coacher = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe_manager')
		->findEquipeByManager($id);
		$equipe = $coacher[0]->getEquipe();

		$session = $request->getSession();

		$session->set('id_equipe',$equipe->getId());


		//recuperation de la liste des joueurs
		$joueurs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findJoueurs($equipe->getId());

		//recuperations des matchs à venir pour l'equipe
		$matchs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->findMatchAVenir($equipe->getId());

		$listeMatch =array();

		foreach ($matchs as $ma) {
			$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($ma->getMatch()->getId());
			
			$ma_eq = array("idMatch"=>$ma->getMatch()->getId(),"heure"=>$ma->getMatch()->getDateMatch(),
				"NomEq1"=>$match_equipe[0]->getEquipe()->getNom(),"NomEq2"=>$match_equipe[1]->getEquipe()->getNom());
			
			array_push($listeMatch, $ma_eq);
		}

		return $this->render('ProjetStatisfootBundle:Equipe:manage_equipe.html.twig', array('manager'=>$manager, 
			'joueurs'=>$joueurs, 'listeMatch'=>$listeMatch, 'equipe'=>$equipe));
	}
}