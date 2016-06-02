<?php
namespace LeBonCoinBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AdvertsRepository extends EntityRepository
{
    public function getFilteredAdverts($string)
    {
        $entityManager = $this->getEntityManager();
        $query   = $entityManager
            ->createQuery('SELECT a
                        FROM LeBonCoinBundle:Adverts a
                        WHERE a.name like :string
                        OR a.description like :string 
                        OR a.author like :string
                        ORDER BY a.name ASC')
            ->setParameters(array(
                'string' => "%".$string."%"));
        return $query->getResult();
    }
}