<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 10/05/2016
 * Time: 22:52
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\CategorieEvent;
use Meupf\PlateformBundle\Form\CategorieEventType;
use Meupf\PlateformBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieEventController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $listCategories = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:CategorieEvent')
            ->getCategories($page, $nbPerPage)
        ;

        $nbPages = ceil(count($listCategories)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:CategorieEvent:index.html.twig', array(
            'listCategories' => $listCategories,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateform:CategorieEvent')->find($id);

        if($categorie === null){
            throw $this->createNotFoundException("la categorie de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:CategorieEvent:view.html.twig', array(
            'categorie' => $categorie
        ));
    }

    public function addAction(Request $request)
    {
        $categorie = new CategorieEvent();
        $form = $this->createForm(new CategorieEventType(), $categorie);

        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été enregistrée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_event_home'));
        }


        return $this->render('MeupfPlateformBundle:CategorieEvent:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieEvent')->find($id);
        $form = $this->createForm(new CategorieEventType(), $categorie);

        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été modifée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_event_home'));
        }

        return $this->render('MeupfPlateformBundle:CategorieEvent:edit.html.twig', array(
            'form' => $form->createView(), 'categorie' => $categorie
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieEvent')->find($id);
        $form = $this->createForm(new CategorieEventType(), $categorie);

        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été supprimée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_event_home'));

        }

        return $this->render('MeupfPlateformBundle:CategorieEvent:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 