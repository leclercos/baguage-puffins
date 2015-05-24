<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DonneesCRBPORepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DonneesLocalisationRepository extends EntityRepository
{
	public function getLocalisation($lieuditId)
	{
		$query = $this->createQueryBuilder('loc')
				->where('loc.id = :id')
				->setParameter('id', $lieuditId);
				
		return $query->getQuery()
					->getOneOrNullResult();
	}
	
	public function getLocalisationByLieudit($lieudit)
	{
		$query = $this->createQueryBuilder('loc')
				->where('lower(loc.lieudit) = lower(:lieudit)')
				->setParameter('lieudit', $lieudit);
				
		return $query->getQuery()
					->getOneOrNullResult();
	}
	
	public function getListLieudit($bagueur, $role)
	{
		$query = $this->createQueryBuilder('loc');
		if($role != 'ROLE_SUPER_ADMIN'){
			if($bagueur != '' && $bagueur != null){
				$query->where('loc.bagueur = :bagueur')
					->setParameter('bagueur', $bagueur);
			}else{
				$query->where('loc.bagueur = :bagueur')
					->setParameter('bagueur', 0);
			}
		}
		$query->orderBy('loc.lieudit', 'ASC');				
		return $query;
	}
}
