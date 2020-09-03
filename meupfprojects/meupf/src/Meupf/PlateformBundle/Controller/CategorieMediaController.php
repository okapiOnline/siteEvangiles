<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 10/05/2016
 * Time: 22:50
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\CategorieMedia;
use Meupf\PlateformBundle\Form\CategorieMediaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CategorieMediaController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        // On récupère notre objet Paginator
        $listCategories = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:CategorieMedia')
            ->getCategories($page, $nbPerPage)
        ;

        $nbPages = ceil(count($listCategories)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:CategorieMedia:index.html.twig', array(
            'listCategories' => $listCategories,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateform:CategorieMedia')->find($id);

        if($categorie === null){
            throw $this->createNotFoundException("la categorie de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:CategorieMedia:view.html.twig', array(
            'categorie' => $categorie
        ));
    }

    public function addAction(Request $request)
    {
        $categorie = new CategorieMedia();
        $form = $this->createForm(new CategorieMediaType(), $categorie);

        if($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été enregistrée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_media_home'));
        }


        return $this->render('MeupfPlateformBundle:CategorieMedia:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieMedia')->find($id);
        $form = $this->createForm(new CategorieMediaType(), $categorie);

        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été modifiée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_media_home'));
        }

        return $this->render('MeupfPlateformBundle:CategorieMedia:edit.html.twig', array(
            'form' => $form->createView(), 'categorie' => $categorie
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieMedia')->find($id);
        $form = $this->createForm(new CategorieMediaType(), $categorie);

        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($categorie);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été supprimée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_media_home'));

        }

        return $this->render('MeupfPlateformBundle:CategorieMedia:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 