<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 04/04/2016
 * Time: 16:39
 */

namespace Meupf\PlateformBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ImageRepository extends EntityRepository{

    public function myFindAll(){
        // Méthode 1 : en passant par l'EntityManager
        $queryBuilder = $this->createNativeNamedQuery('i');
        $query = $queryBuilder->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function getEvents($page, $nbPerPage){
        $query = $this->createQueryBuilder('i')

            // Jointure sur l'attribut image
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