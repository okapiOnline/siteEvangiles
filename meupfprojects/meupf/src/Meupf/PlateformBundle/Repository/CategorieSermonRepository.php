<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 10/05/2016
 * Time: 19:43
 */

namespace Meupf\PlateformBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CategorieSermonRepository extends EntityRepository{

    public function myFindAll(){
        $queryBuilder = $this->createNativeNamedQuery('c');
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getCategories($page, $nbPerPage){
        $query = $this->createQueryBuilder('c')
            ->getQuery();

        $query ->setFirstResult(($page-1) * $nbPerPage)
               ->setMaxResults($nbPerPage);

        return new Paginator($query, true);
    }

    public function getCategorieSermon($nbPerPage){
        $queryBuilder = $this->createQueryBuilder('c');
        $query = $queryBuilder->getQuery();
        $query->setMaxResults($nbPerPage);
        $result = $query->getResult();
        return $result;
    }

    public function getTot(){
        $DM = $this->_em->createQueryBuilder();
        $query = $DM
            ->select('s.id, s.title, COUNT(s.id) as sermon_count')
            ->from('MeupfPlateformBundle:CategorieSermon', 'c')
            ->innerJoin('c.sermons', 's')
            ->groupBy('c.id')
        ;
        $categories= $query->getQuery()->getResult();
        return $categories;
    }
} 