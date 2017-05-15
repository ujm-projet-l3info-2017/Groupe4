<?php

namespace Projet\StatisfootBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Projet\StatisfootBundle\Entity\match_equipe;
use Projet\StatisfootBundle\Entity\match_foot;
use Projet\StatisfootBundle\Entity\match_joueur;
use Projet\StatisfootBundle\Entity\equipe;
/**
* 
*/
class MatchController extends Controller
{

	public function menuAction(){
		$compet = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:competition')->findAll();

		$clubs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:club')->findAll();

		return $this->render('ProjetStatisfootBundle:Match:menu.html.twig',array('competition'=>$compet,'lesClubs'=>$clubs));
	}
	
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

	public function index_manageAction(){
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


		return $this->render('ProjetStatisfootBundle:Match:match.html.twig', array('match'=>$m, 
			'adversairesEq1'=>$tabadversaire1,'adversairesEq2'=>$tabadversaire2, 'faceface'=>$faceface, 'classement'=>$classement,
			'classementButeurs'=>$classementButeurs, 'nomCompet'=>$match->getCompetition()->getNomCompet()));
	}

	//Controller page gestion Avant Match
	public function avant_matchAction($id, Request $request)
	{

		$id_equipe = $request->getSession()->get('id_equipe');

		$equipe =  $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')->find($id_equipe);

		$titu = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findTitulaires($equipe->getId());

		$remplac = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findRemplacants($equipe->getId());
		
		$titulaires = array();
		$tab = array();
		//on trie la liste des titulaires par poste
		foreach ($titu as $tit) {
			if ($tit->getPoste() == 'GB') {
				$rang = 1;
			} 
			elseif ($tit->getPoste() == 'DC' || $tit->getPoste() == 'LIB') {
				$rang=2;
			} 
			elseif ($tit->getPoste() == 'LD' || $tit->getPoste() == 'LG') {
				$rang=3;	
			}
			elseif ($tit->getPoste() == 'DEF') {
				$rang=4;	
			}
			elseif ($tit->getPoste() == 'MR' || $tit->getPoste() == 'MO') {
				$rang=5;	
			}
			elseif ($tit->getPoste() == 'AG' || $tit->getPoste() == 'AD') {
				$rang=6;
			}
			else{
				$rang=7;
			}

			array_push($tab, $rang);
			array_push($titulaires, array('joueur'=>$tit->getJoueur(),'poste'=>$tit->getPoste(),'rang'=>$rang));
		}

		array_multisort($tab, SORT_ASC, $titulaires);

		$remplacants = array();
		$tab = array();
		//on trie la liste des remplaçants par poste aussi 
		foreach ($remplac as $rem) {
			if ($rem->getPoste() == 'GB') {
				$rang=1;
			} 
			elseif ($rem->getPoste() == 'DC' || $rem->getPoste() == 'LIB') {
				$rang=2;
			} 
			elseif ($rem->getPoste() == 'LD' || $rem->getPoste() == 'LG') {
				$rang=3;	
			}
			elseif ($rem->getPoste() == 'DEF') {
				$rang=4;	
			}
			elseif ($rem->getPoste() == 'MR' || $rem->getPoste() == 'MO') {
				$rang=5;	
			}
			elseif ($rem->getPoste() == 'AG' || $rem->getPoste() == 'AD') {
				$rang=6;
			}
			else{
				$rang=7;
			}

			array_push($tab, $rang);
			array_push($remplacants, array('joueur'=>$rem->getJoueur(),'poste'=>$rem->getPoste(),'rang'=>$rang));
		}

		array_multisort($tab, SORT_ASC, $remplacants);

		//fin recuperation des joueurs de l'equipe

		$match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')->find($id);

		$req = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findAdversaire($match->getId(), $equipe->getId());

		$equipeAdv = $req[0]->getEquipe();

		//on recupere les cinqs derniers match pour l'equipe adverse
		$matchs = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->find5DerniersMatch($equipeAdv->getId());

		$derniersMatchsAdv =array();

		foreach ($matchs as $ma) {
			$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($ma->getMatch()->getId());
			
			$ma_eq = array("idMatch"=>$ma->getMatch()->getId(),"heure"=>$ma->getMatch()->getDateMatch(),
				"NomEq1"=>$match_equipe[0]->getEquipe()->getNom(),"Eq1But"=>$match_equipe[0]->getButMarq(),
				"NomEq2"=>$match_equipe[1]->getEquipe()->getNom(),"Eq2But"=>$match_equipe[1]->getButMarq());
			
			array_push($derniersMatchsAdv, $ma_eq);
		}

		//on recupere les 5 derniers face à face entre les 2 equipes 
		$faceface =  $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->faceface($equipe->getId(), $equipeAdv->getId());		

		//classement des equipes dans la competion concerné par ce match
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


		///LA SIMULATION

		//les 5DerniersMatch de l'equipe
		$derniersMatch = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->find5DerniersMatch($equipe->getId());

		$poste = 'GB';
		$gardiens = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findJoueursPoste($equipe->getId(),$poste);

		$n = count($gardiens);
		$bool = true;
		while ($bool == true) {

			$bool = false;

			for ($i = 0; $i < $n-1; $i++){

				$nbm1 = 0;
				$rb1 = 0;
				$crt1 = 0;
				$nba1 = 0;

				$nbm2 = 0;
				$rb2 = 0;
				$crt2 = 0;
				$nba2 = 0;


				foreach ($derniersMatch as $ma) {
					//pour le joueur $i
					$ma_jou = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')
					->findMatchJoueur($ma->getMatch()->getId(), $gardiens[$i]->getId());

					if ($ma_jou != null) {
						$nbm1+= 1;
						$rb1+= $ma->$getButEnc();
						$nba1+= $ma_jou->getNbBalleArret();
						$crt1+= $ma_jou->getCartonJaune();
						//si le joueur a pris un carton rouge
						if ($ma_jou->getCartonRouge()) {
							$crt1+= 2;
						}

					}

					//pour le joueur $i+1
					$ma_jou = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_joueur')
					->findMatchJoueur($ma->getMatch()->getId(), $gardiens[$i+1]->getId());

					if ($ma_jou != null) {
						$nbm2+= 1;
						$rb2+= $ma->$getButEnc();
						$nba2+= $ma_jou->getNbBalleArret();
						$crt2+= $ma_jou->getCartonJaune();
						//si le joueur a pris un carton rouge
						if ($ma_jou->getCartonRouge()) {
							$crt2+= 2;
						}
					}
				}

				$rb1 = $rb1/$nbm1;
				$rb2 =$rb2/$nbm2;

				$nba1 = $nba1/$nbm1;
				$nba2 = $nba2/$nbm2;
				
				if (($nbm1-$nbm2) < -2) {
					//on garde l'ordre	
				}
				elseif (($nbm1-$nbm2) > 2) {
					$joueur  = $gardiens[$i];
					$gardiens[$i] = $gardiens[$i+1];
					$gardiens[$i+1] = $joueur;
					$bool = true;
				}
				else{
					if ($rb1 < $rb2) {
						$joueur  = $gardiens[$i];
						$gardiens[$i] = $gardiens[$i+1];
						$gardiens[$i+1] = $joueur;
						$bool = true;
					}
					elseif ($rb1 > $rb2) {
						//on garde l'ordre
					}
					else{
						if ($nba1 > $nba2) {
							$joueur  = $gardiens[$i];
							$gardiens[$i] = $gardiens[$i+1];
							$gardiens[$i+1] = $joueur;
							$bool = true;
						}
						elseif ($nba1 < $nba2) {
							//on garde l'ordre
						}
						else{
							if ($crt1 < $crt2) {
								$joueur  = $gardiens[$i];
								$gardiens[$i] = $gardiens[$i+1];
								$gardiens[$i+1] = $joueur;
								$bool = true;
							}
						}
					}
				}
			}
		}
		

		return $this->render('ProjetStatisfootBundle:Match:manage_avant_match.html.twig', array(
			'match'=>$match,'equipe'=>$equipe, 'equipeAdv'=>$equipeAdv, 'faceface'=>$faceface,'classement'=>$classement,
			'titulaires'=>$titulaires, 'remplacants'=>$remplacants,'derniersMatch'=>$derniersMatchsAdv,
			'classementButeurs'=>$classementButeurs, 'nomCompet'=>$match->getCompetition()->getNomCompet()));
	}

	//function qui gere les matchs en cours

	public function match_encoursAction($id, Request $request){

		$em = $this->getDoctrine()->getManager();

		$id_equipe = $request->getSession()->get('id_equipe');

		$match = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_foot')->find($id);

		$equipe =  $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:equipe')->find($id_equipe);

		$req = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findAdversaire($match->getId(), $equipe->getId());
		$equipeAdv = $req[0]->getEquipe();

		$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($match->getId());

		//renseignement des resultat du match pour l'equipe 1	
		$match_equipe[0]->setButMarq(0);
		$match_equipe[0]->setButEnc(0);
		$match_equipe[0]->setCornerObt(0);
		$match_equipe[0]->setCornerConc(0);
		$match_equipe[0]->setTirCadre(0);
		$match_equipe[0]->setCfObt(0);
		$match_equipe[0]->setCfConc(0);
		$match_equipe[0]->setPenaltyObt(0);
		$match_equipe[0]->setPenaltyConc(0);

		//renseignement des resultat du match pour l'equipe 2 
		$match_equipe[1]->setButMarq(0);
		$match_equipe[1]->setButEnc(0);
		$match_equipe[1]->setCornerObt(0);
		$match_equipe[1]->setCornerConc(0);
		$match_equipe[1]->setTirCadre(0);
		$match_equipe[1]->setCfObt(0);
		$match_equipe[1]->setCfConc(0);
		$match_equipe[1]->setPenaltyObt(0);
		$match_equipe[1]->setPenaltyConc(0);

		$titu = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findTitulaires($equipe->getId());

		$remplac = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:joueur_equipe')
		->findRemplacants($equipe->getId());
		
		$titulaires = array();
		$tab = array();
		//on trie la liste des titulaires par poste
		$em = $this->getDoctrine()->getManager();
		foreach ($titu as $tit) {
			if ($tit->getPoste() == 'GB') {
				$rang = 1;
			} 
			elseif ($tit->getPoste() == 'DC' || $tit->getPoste() == 'LIB') {
				$rang=2;
			} 
			elseif ($tit->getPoste() == 'LD' || $tit->getPoste() == 'LG') {
				$rang=3;	
			}
			elseif ($tit->getPoste() == 'MD') {
				$rang=4;	
			}
			elseif ($tit->getPoste() == 'MR' || $tit->getPoste() == 'MO') {
				$rang=5;	
			}
			elseif ($tit->getPoste() == 'AG' || $tit->getPoste() == 'AD') {
				$rang=6;
			}
			else{
				$rang=7;
			}

			//Enregistrement de chaque joueur retenu pour le match dans la table match_joueur

			$match_joueur = new match_joueur();

			$match_joueur->setPoste($tit->getPoste());
			$match_joueur->setMinEntre(0);
			$match_joueur->setMinSortie(90);
			$match_joueur->setNbDuelGagne(0);
			$match_joueur->setNbBalleInter(0);
			$match_joueur->setNbBalleRecup(0);
			$match_joueur->setNbBalleArret(0);
			$match_joueur->setNbCentre(0);
			$match_joueur->setNbTacle(0);
			$match_joueur->setCartonRouge(false);
			$match_joueur->setCartonJaune(0);
			$match_joueur->setNbTirCadre(0);

			$match_joueur->setJoueur($tit->getJoueur());
			$match_joueur->setMatchFoot($match);

			$em->persist($match_joueur);

			array_push($tab, $rang);
			array_push($titulaires, array('joueur'=>$tit->getJoueur(),'poste'=>$tit->getPoste(),'rang'=>$rang));
		}

		//l'enregistrement effectif en base de données
		$em->flush();

		array_multisort($tab, SORT_ASC, $titulaires);


		$remplacants = array();
		$tab = array();
		//on trie la liste des remplaçants par poste aussi 
		foreach ($remplac as $rem) {
			if ($rem->getPoste() == 'GB') {
				$rang=1;
			} 
			elseif ($rem->getPoste() == 'DC' || $rem->getPoste() == 'LIB') {
				$rang=2;
			} 
			elseif ($rem->getPoste() == 'LD' || $rem->getPoste() == 'LG') {
				$rang=3;	
			}
			elseif ($rem->getPoste() == 'DEF') {
				$rang=4;	
			}
			elseif ($rem->getPoste() == 'MR' || $rem->getPoste() == 'MO') {
				$rang=5;	
			}
			elseif ($rem->getPoste() == 'AG' || $rem->getPoste() == 'AD') {
				$rang=6;
			}
			else{
				$rang=7;
			}

			array_push($tab, $rang);
			array_push($remplacants, array('joueur'=>$rem->getJoueur(),'poste'=>$rem->getPoste(),'rang'=>$rang));
		}

		array_multisort($tab, SORT_ASC, $remplacants);


		$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
			->findMatchEquipe($match->getId());


		return $this->render('ProjetStatisfootBundle:Match:manage_match_encours.html.twig', array('equipe'=>$equipe,
			'titulaires'=>$titulaires, 'remplacants'=>$remplacants,'matchEquipe'=>$match_equipe,'match'=>$match));	
	}

	//ajout d'un evement pour une equipe par rapport à un match donné

	public function match_eventAction($idM,$idA, Request $request){

		//on recupere l'equipe grace à la session
		$id_equipe = $request->getSession()->get('id_equipe');

		$em = $this->getDoctrine()->getManager();

		$match_equipe = $this->getDoctrine()->getManager()->getRepository('ProjetStatisfootBundle:match_equipe')
		->findMatchEquipe($idM);

		switch ($idA) {
			case 1 :
				if ($id_equipe == $match_equipe[0]->getEquipe()->getId()) {

					$match_equipe[0]->setCornerObt($match_equipe[0]->getCornerObt()+1);	
					$match_equipe[1]->setCornerConc($match_equipe[1]->getCornerConc()+1);
				}
				else{
					$match_equipe[1]->setCornerObt($match_equipe[1]->getCornerObt()+1);	
					$match_equipe[0]->setCornerConc($match_equipe[0]->getCornerConc()+1);
				}
				break;

			case 2 :
				if ($id_equipe == $match_equipe[0]->getEquipe()->getId()) {

					$match_equipe[0]->setCfObt($match_equipe[0]->getCfObt()+1);	
					$match_equipe[1]->setCfConc($match_equipe[1]->getCfConc()+1);
				}
				else{
					$match_equipe[1]->setCfObt($match_equipe[1]->getCfObt()+1);	
					$match_equipe[0]->setCfConc($match_equipe[0]->getCfConc()+1);
				}
				break;
			
			default:
				if ($id_equipe == $match_equipe[0]->getEquipe()->getId()) {

					$match_equipe[0]->setPenaltyObt($match_equipe[0]->getPenaltyObt()+1);	
					$match_equipe[1]->setPenaltyConc($match_equipe[1]->getPenaltyConc()+1);
				}
				else{
					$match_equipe[1]->setPenaltyObt($match_equipe[1]->getPenaltyObt()+1);	
					$match_equipe[0]->setPenaltyConc($match_equipe[0]->getPenaltyConc()+1);
				}
				break;
		}

		$em->flush();

		return new Response($idM." et ".$idA, 200);
	}
}