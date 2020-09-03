<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 31/03/2016
 * Time: 17:55
 */

namespace Meupf\PlateformBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller{

    public function indexAction()
    {

        // Ici, on récupérera la liste des annonces, puis on la passera au template

        // Mais pour l'instant, on ne fait qu'appeler le template
        return $this->render('MeupfPlateformBundle:Page:index.html.twig');
    }

    public function viewAction($id)
    {
        // Ici, on récupérera l'annonce correspondante à l'id $id

        return $this->render('MeupfPlateformBundle:Page:view.html.twig', array(
            'id' => $id
        ));
    }

    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('meupf_platform_view', array('id' => 5));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('MeupfPlateformBundle:Page:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('meupf_platform_view', array('id' => 5));
        }

        return $this->render('MeupfPlateformBundle:Page:edit.html.twig');
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('MeupfPlateformBundle:Page:delete.html.twig');
    }

} 