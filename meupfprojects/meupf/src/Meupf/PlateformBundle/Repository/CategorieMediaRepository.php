<?php

namespace Meupf\PlateformBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * CategorieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategorieMediaRepository extends EntityRepository
{
    public function myFindAll(){
        // Méthode 1 : en passant par l'EntityManager
        $queryBuilder = $this->createNativeNamedQuery('c');
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getCategories($page, $nbPerPage){
        $query = $this->createQueryBuilder('c')
            ->getQuery();

        // On définit l'annonce à partir de laquelle commencer la liste
        $query ->setFirstResult(($page-1) * $nbPerPage)
            // Ainsi que le nombre d'annonce à afficher sur une page
            ->setMaxResults($nbPerPage);

        // Enfin, on retourne l'objet Paginator correspondant à la requête construite
        // (n'oubliez pas le use correspondant en début de fichier)
        return new Paginator($query, true);
    }

}