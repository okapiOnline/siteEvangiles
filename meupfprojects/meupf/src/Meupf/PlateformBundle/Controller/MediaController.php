<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 09/05/2016
 * Time: 17:34
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Media;
use Meupf\PlateformBundle\Form\MediaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MediaController extends Controller{

    public function indexAction($page){
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 3;

        $em =   $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Media');

        $listMedias = $em->getMedias($page, $nbPerPage);

        $nbPages = ceil(count($listMedias)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:Media:index.html.twig', array(
            'listMedias' => $listMedias,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));
    }

    public function addAction(Request $request){
        $media = new Media();
        $form = $this->createForm(new MediaType(), $media);

        if($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()
                       ->getManager();

            $em->persist($media);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La video a bien été enregistrée avec succès.');
            return $this->redirect($this->generateUrl('meupf_media_home'));
        }

        return $this->render('MeupfPlateformBundle:Media:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('MeupfPlateformBundle:Media')->find($id);
        $form = $this->createForm(new MediaType(), $media);

        if ($media == null) {
            throw $this->createNotFoundException("La video d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La video a bien été modifiée avec succès.');
            return $this->redirect($this->generateUrl('meupf_media_home'));
        }

        return $this->render('MeupfPlateformBundle:Media:edit.html.twig', array(
            'form' => $form->createView(), 'media' => $media
        ));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('MeupfPlateformBundle:Media')->find($id);

        if($media === null){
            throw $this->createNotFoundException("la video de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:Media:view.html.twig', array(
            'media' => $media
        ));
    }


    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('MeupfPlateformBundle:Media')->find($id);
        $form = $this->createForm(new MediaType(), $media);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($media == null) {
            throw $this->createNotFoundException("La video d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($media);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'La video a bien été supprimée avec succès.');

            return $this->redirect($this->generateUrl('meupf_media_home'));

        }

        // Si la requête est en GET, on affiche une page de confirmation avant de delete
        return $this->render('MeupfPlateformBundle:Media:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 