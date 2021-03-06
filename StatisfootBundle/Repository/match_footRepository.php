<?php

namespace Projet\StatisfootBundle\Repository;

/**
 * match_footRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class match_footRepository extends \Doctrine\ORM\EntityRepository
{
	public function findMatchCompet($id_compet){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.competition','compet')
			->where('compet.id = :id')
			->setParameter('id',$id_compet);
			
		return $qb->getQuery()->getResult();
	}

	public function findMatchCompetJour($id_compet,$num){
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.competition','compet')
			->where('compet.id = :id')
			->andWhere('m.num_journee = :num')
			->setParameter('id',$id_compet)
			->setParameter('num',$num);
			
		return $qb->getQuery()->getResult();
	}
}
