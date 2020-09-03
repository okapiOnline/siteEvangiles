<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 15/05/2016
 * Time: 11:13
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Temoignage;
use Meupf\PlateformBundle\Form\TemoignageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TemoignageController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $em =   $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Temoignage');

        $listTemoigns = $em->getTemoignages($page, $nbPerPage);

        $nbPages = ceil(count($listTemoigns)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:Temoignage:index.html.twig', array(
            'listTemoigns' => $listTemoigns,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository('MeupfPlateformBundle:Temoignage')->find($id);
        // $catSermons = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->getCategorieSermon(5);


        if($temoignage === null){
            throw $this->createNotFoundException("le temoignage de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:Temoignage:view.html.twig', array(
            'temoignage' => $temoignage,
        ));
    }


    public function addAction(Request $request)
    {
        $temoignage = new Temoignage();
        $form = $this->createForm(new TemoignageType(), $temoignage);

        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($temoignage);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le temoignage a bien été enregistré avec succès');

            return $this->redirect($this->generateUrl('meupf_temoignage_home'));
        }

        return $this->render('MeupfPlateformBundle:Temoignage:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository('MeupfPlateformBundle:Temoignage')->find($id);
        $form = $this->createForm(new TemoignageType(), $temoignage);

        if ($temoignage == null) {
            throw $this->createNotFoundException("Le temoignage d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            // $em->persist($sermon);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le temoignage a bien été modifié avec succès');
            return $this->redirect($this->generateUrl('meupf_temoignage_home'));
        }

        return $this->render('MeupfPlateformBundle:Temoignage:edit.html.twig', array(
            'form' => $form->createView(), 'temoignage' => $temoignage
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository('MeupfPlateformBundle:Temoignage')->find($id);
        $form = $this->createForm(new TemoignageType(), $temoignage);

        if ($temoignage == null) {
            throw $this->createNotFoundException("Le temoignage d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($temoignage);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le temoignage a bien été supprimé avec succès');

            return $this->redirect($this->generateUrl('meupf_temoignage_home'));

        }

        return $this->render('MeupfPlateformBundle:Temoignage:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 