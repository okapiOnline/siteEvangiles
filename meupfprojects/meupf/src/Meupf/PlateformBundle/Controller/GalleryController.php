<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 01/05/2016
 * Time: 13:46
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Gallery;
use Meupf\PlateformBundle\Form\GalleryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller{

    public function indexAction($page){
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 3;

        $em =   $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Gallery');

        $listGallerys = $em->getGallerys($page, $nbPerPage);

        $nbPages = ceil(count($listGallerys)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:Gallery:index.html.twig', array(
            'listGallerys' => $listGallerys,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));
    }

    public function addAction(Request $request){
        $gallery = new Gallery();
        $form = $this->createForm(new GalleryType(), $gallery);

        if($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()
                ->getManager();

            $em->persist($gallery);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été enregistrée avec succès.');
            return $this->redirect($this->generateUrl('meupf_gallerie_home'));
        }

        return $this->render('MeupfPlateformBundle:Gallery:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('MeupfPlateformBundle:Media')->find($id);
        $form = $this->createForm(new GalleryType(), $gallery);

        if ($gallery == null) {
            throw $this->createNotFoundException("L'image d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été modifiée avec succès.');
            return $this->redirect($this->generateUrl('meupf_gallerie_home'));
        }

        return $this->render('MeupfPlateformBundle:Gallery:edit.html.twig', array(
            'form' => $form->createView(), 'media' => $gallery
        ));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('MeupfPlateformBundle:Gallery')->find($id);

        if($gallery === null){
            throw $this->createNotFoundException("l'image de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:Gallery:view.html.twig', array(
            'gallery' => $gallery
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gallery = $em->getRepository('MeupfPlateformBundle:Gallery')->find($id);
        $form = $this->createForm(new GalleryType(), $gallery);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($gallery == null) {
            throw $this->createNotFoundException("L'image d'id ".$id." n'existe pas.");
        }


        if ($form->handleRequest($request)) {
            $em->remove($gallery);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'L\'image a bien été supprimée avec succès.');

            return $this->redirect($this->generateUrl('meupf_gallerie_home'));

        }

        return $this->render('MeupfPlateformBundle:Gallery:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }

} 