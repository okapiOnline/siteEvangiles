<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 10/05/2016
 * Time: 22:53
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\CategorieSermon;
use Meupf\PlateformBundle\Form\CategorieSermonType;
use Meupf\PlateformBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieSermonController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $listCategories = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:CategorieSermon')
            ->getCategories($page, $nbPerPage)
        ;

        $nbPages = ceil(count($listCategories)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:CategorieSermon:index.html.twig', array(
            'listCategories' => $listCategories,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateform:CategorieSermon')->find($id);

        if($categorie === null){
            throw $this->createNotFoundException("la categorie de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:CategorieSermon:view.html.twig', array(
            'categorie' => $categorie
        ));
    }

    public function addAction(Request $request)
    {
        $categorie = new CategorieSermon();
        $form = $this->createForm(new CategorieSermonType(), $categorie);

        if($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été enregistrée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_sermon_home'));
        }

        return $this->render('MeupfPlateformBundle:CategorieSermon:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->find($id);
        $form = $this->createForm(new CategorieSermonType(), $categorie);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }


        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été modifiée avec succès.');
            return $this->redirect($this->generateUrl('meupf_categorie_sermon_home'));
        }

        return $this->render('MeupfPlateformBundle:CategorieSermon:edit.html.twig', array(
            'form' => $form->createView(), 'categorie' => $categorie
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->find($id);
        $form = $this->createForm(new CategorieType, $categorie);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }

        if ($form->handleRequest($request)) {
            $em->remove($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été supprimée avec succès.');
            return $this->redirect($this->generateUrl('meupf_categorie_sermon_home'));

        }

        return $this->render('MeupfPlateformBundle:CategorieSermon:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 