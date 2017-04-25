<?php

namespace Projet\StatisfootBundle\Repository;
//namespace Projet\StatisfootBundle\Entity;
use Doctrine\ORM\EntityRepository;
/**
 * match_equipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class match_equipeRepository extends EntityRepository
{
	//recuperation des equipes pour un match donné
	public function findMatchEquipe($id_match){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->addSelect('match')
			->leftJoin('m.equipe','eq')
			->addSelect('eq')
			->where('match.id = :id')
			->setParameter('id',$id_match);
			
		return $qb->getQuery()->getResult();
	}

	//recupération des competitions dans lesquelles est engagées l'equipe
	public function findCompetEquipe($idE){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->leftJoin('m.equipe','eq')
			->leftJoin('match.competition','compet')
			->select('DISTINCT compet.id, compet.id AS id, compet.nomCompet AS nom')
			->where('eq.id = :idE')
			->setParameter('idE',$idE);
		return $qb->getQuery()->getResult();
	}

	//recupération des equipes engagé dans une compétition
	public function findEquipeCompet($idC){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->leftJoin('m.equipe','eq')
			->leftJoin('match.competition','compet')
			->select('DISTINCT eq.id, eq.id AS id, eq.nom AS nom')
			->where('compet.id = :idC')
			->setParameter('idC',$idC);
		return $qb->getQuery()->getResult();
	}

	//recupération des resultats des matchs d'une compétion données
	public function findResultatsCompet($idC){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->leftJoin('match.competition','compet')
			->where('compet.id = :idC')
			->setParameter('idC',$idC);
		return $qb->getQuery()->getResult();
	}

	//recupération des matchs pour une equipe donnée
	public function findMatch($id_equipe){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->addSelect('match')
			->leftJoin('m.equipe','eq')
			->where('eq.id = :id')
			->setParameter('id',$id_equipe);
		return $qb->getQuery()->getResult();
	}

	//recupération des matchs à venir pour une equipe donnée
	public function findMatchAVenir($id_equipe){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->addSelect('match')
			->leftJoin('m.equipe','eq')
			->where('eq.id = :id')
			->andwhere('match.dateMatch > :date')
			->setParameter('id', $id_equipe)
			->setParameter('date', new \DateTIME());
		return $qb->getQuery()->getResult();
	}

	// recuperation de tout les matchs d'une equipe.
	public function findLesMatchs($id){
		$matchs = $this->createQueryBuilder('m')
		->leftJoin('m.match','match')
			->addSelect('match')
			->leftJoin('m.equipe','eq')
			->addSelect('eq')
			->where('eq.id = :id')
			->setParameter('id',$id);
		//->orderBy('match.dateMatch','DESC');
		return $matchs->getQuery()->getResult();
	}
// recuperation d'un adversaire
	public function findAdversaire($idmatch, $ideq){
		$matchs = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->addSelect('match')
			->leftJoin('m.equipe','eq')
			->addSelect('eq')
			->where('eq.id != :id')
			->andwhere('match.id = :idmatch')
			->setParameter('id',$ideq)
			->setParameter('idmatch',$idmatch);
			return $matchs->getQuery()->getResult();
	}

	public function faceface($id1, $id2){
		$query2 = $this->createQueryBuilder('m1');
		$ma = $query2->select('match1.id')
			->leftJoin('m1.match','match1')
			->leftJoin('m1.equipe','eq1')
			->where('eq1.id = :id1');

		$query = $this->createQueryBuilder('m');

		$qb = $query->select('m')
			->leftJoin('m.match','match')
			->leftJoin('m.equipe','eq')
			->addSelect('match')
			->addSelect('eq')
			->where('eq.id = :id')
			->andWhere($query->expr()->in('match.id',$ma->getDQL()))
			->setMaxResults('5')
			->setParameter('id',$id2)
			->setParameter('id1',$id1);

		return $query->getQuery()->getResult();
	}
}

}
