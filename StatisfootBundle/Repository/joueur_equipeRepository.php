<?php

namespace Projet\StatisfootBundle\Repository;

use Doctrine\ORM\EntityRepository;
/**
 * joueur_equipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class joueur_equipeRepository extends EntityRepository
{
	public function findJoueurs($idE){
		$qb = $this->createQueryBuilder('j')
			->leftJoin('j.equipe','eq')
			->leftJoin('j.joueur','joue')
			->addSelect('joue')
			->where('j.date_fin > :date')
			->andWhere('eq.id = :id')
			->setParameter('date', new \DateTIME())
			->setParameter('id', $idE);

		return $qb->getQuery()->getResult();
	}

	public function findTitulaires($idE){
		$qb = $this->createQueryBuilder('j')
			->leftJoin('j.equipe','eq')
			->leftJoin('j.joueur','joue')
			->addSelect('joue')
			->where('j.date_fin > :date')
			->andWhere('j.titulaire = :tit')
			->andWhere('eq.id = :id')
			->setParameter('date', new \DateTIME())
			->setParameter('tit', true)
			->setParameter('id', $idE);

		return $qb->getQuery()->getResult();
	}

	public function findRemplacants($idE){
		$qb = $this->createQueryBuilder('j')
			->leftJoin('j.equipe','eq')
			->leftJoin('j.joueur','joue')
			->addSelect('joue')
			->where('j.date_fin > :date')
			->andWhere('j.remplacant = :rem')
			->andWhere('eq.id = :id')
			->setParameter('date', new \DateTIME())
			->setParameter('rem', true)
			->setParameter('id', $idE);

		return $qb->getQuery()->getResult();
	}

	public function findEquipe($idJ){
		$qb = $this->createQueryBuilder('j')
			->leftJoin('j.equipe','eq')
			->leftJoin('j.joueur','joue')
			->addSelect('eq')
			->where('j.date_fin > :date')
			->andWhere('j.id = :id')
			->setParameter('date', new \DateTIME())
			->setParameter('id', $idJ);

		return $qb->getQuery()->getResult();
	}

	public function findCoequipiers($idJ, $idE){
		$qb = $this->createQueryBuilder('j')
			->leftJoin('j.equipe','eq')
			->leftJoin('j.joueur','joue')
			->addSelect('joue')
			->where('j.date_fin > :date')
			->andWhere('joue.id != :idJ')
			->andWhere('eq.id = :idE')
			->setParameter('date', new \DateTIME())
			->setParameter('idJ', $idJ)
			->setParameter('idE', $idE);

		return $qb->getQuery()->getResult();
	}

	//recuperation des equipes pour lesquelles a joué le joueur
	public function findLesEquipes($idJ){
		$qb = $this->createQueryBuilder('j')
			->leftJoin('j.equipe','eq')
			->leftJoin('j.joueur','joue')
			->leftJoin('eq.club','c')
			->leftJoin('eq.niveau','n')
			->select('eq.id AS id, eq.nom AS nomE, c.nomClub AS nomC, n.libelleNiv AS niv, j.date_debut AS date')
			->where('joue.id = :idJ')
			->setParameter('idJ', $idJ);

		return $qb->getQuery()->getResult();
	}

	public function findContrat($idJ){
		$qb = $this->createQueryBuilder('j')
			->leftJoin('j.joueur','joue')
			->where('j.date_fin > :date')
			->andWhere('joue.id = :id')
			->setParameter('date', new \DateTIME())
			->setParameter('id', $idJ);

		return $qb->getQuery()->getResult();
	}	
}
