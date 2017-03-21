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
	public function findMatchEquipe($idmatch){
		$qrb = $this->createQueryBuilder('m')
			->leftJoin('m.match','match')
			->addSelect('match')
			->leftJoin('m.equipe','eq')
			->addSelect('eq')
			->where('match.id = :id')
			->setParameter('id',$idmatch);
			
		return $qrb->getQuery()->getResult();
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
	
}
