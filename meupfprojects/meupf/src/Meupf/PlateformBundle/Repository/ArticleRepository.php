<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 01/04/2016
 * Time: 17:09
 */

namespace Meupf\PlateformBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    public function myFindAll(){
        // Méthode 1 : en passant par l'EntityManager
        $queryBuilder = $this->createNativeNamedQuery('a');
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getArticles(){
        $query = $this->createQueryBuilder('a')

            // Jointure sur l'attribut categories
            ->leftJoin('a.categorie', 'c')
            ->addSelect('c')
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();

        $results = $query ->getResult();
        return $results;
    }

    public function getPublishedQueryBuilder(){
        return $this
            ->createQueryBuilder('a')
            ->where('a.online = :online')
            ->setParameter('online', true);
    }

    public function getCategories(){
        $queryBuilder = $this->_em->createQueryBuilder();
        $queryBuilder->select('a')
            ->from('Meupf\PlateformBundle\Entity\Article', 'a')
            ->leftJoin('a.categorie', 'c')
            ->addSelect('c');
        $query= $queryBuilder->getQuery();
        $resultat = $query->getResult();
        return $resultat;
    }

    public function lastArticle($limit){
        $queryBuilder = $this->createQueryBuilder('a')
            ->select('a')
            //->from('MeupfPlateformBundle:Article', 'a')
            ->where('a.online = :online')
            ->orderBy('a.createdAt', 'DESC')
            ->setParameter('online', true)
            //->setParameter('identifier', 100)
            ->setMaxResults($limit);
        $query = $queryBuilder->getQuery();
        $resultat = $query->getResult();
        return $resultat;
    }

    public function getArticleCategorie($page, $nbPerPage, $id){
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.categorie', 'c') //categorie_id pour sermon
            ->addSelect('c')
            ->where('c.id = :id')
            ->andWhere('a.online = :online')
            ->orderBy('a.createdAt', 'DESC')
            ->setParameter('id', $id)
            ->setParameter('online', true)
            ->getQuery();
        $query ->setFirstResult(($page-1) * $nbPerPage)
            ->setMaxResults($nbPerPage);
        return new Paginator($query, true);
    }
} 