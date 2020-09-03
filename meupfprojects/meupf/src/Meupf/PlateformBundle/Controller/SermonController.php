<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 07/04/2016
 * Time: 22:18
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Sermon;
use Meupf\PlateformBundle\Form\SermonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SermonController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

          $em =   $this->getDoctrine()
                        ->getManager()
                        ->getRepository('MeupfPlateformBundle:Sermon');

        $listSermons = $em->getSermons($page, $nbPerPage);

        $nbPages = ceil(count($listSermons)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:Sermon:index.html.twig', array(
            'listSermons' => $listSermons,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sermon = $em->getRepository('MeupfPlateformBundle:Sermon')->find($id);
       // $catSermons = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->getCategorieSermon(5);


        if($sermon === null){
            throw $this->createNotFoundException("le sermon de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:Sermon:view.html.twig', array(
            'sermon' => $sermon,
        ));
    }


    public function addAction(Request $request)
    {
        $sermon = new Sermon();
        $form = $this->createForm(new SermonType(), $sermon);

        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sermon);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le sermon a bien été enregistré avec succès');

            return $this->redirect($this->generateUrl('meupf_sermon_home'));
        }

        return $this->render('MeupfPlateformBundle:Sermon:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $sermon = $em->getRepository('MeupfPlateformBundle:Sermon')->find($id);
        $form = $this->createForm(new SermonType(), $sermon);

        if ($sermon == null) {
            throw $this->createNotFoundException("Le sermon d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
           // $em->persist($sermon);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le sermon a bien été modifié avec succès');
            return $this->redirect($this->generateUrl('meupf_sermon_home'));
        }


        // Ici, on s'occupera de la création et de la gestion du formulaire
        return $this->render('MeupfPlateformBundle:Sermon:edit.html.twig', array(
            'form' => $form->createView(), 'sermon' => $sermon
        ));
    }

    public function deleteAction($id, Request $request)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        // On récupère l'entité correspondant à l'id $id
        $sermon = $em->getRepository('MeupfPlateformBundle:Sermon')->find($id);
        $form = $this->createForm(new SermonType(), $sermon);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($sermon == null) {
            throw $this->createNotFoundException("Le sermon d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($sermon);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le sermon a bien été supprimé avec succès');

            return $this->redirect($this->generateUrl('meupf_sermon_home'));

        }

        // Si la requête est en GET, on affiche une page de confirmation avant de delete
        return $this->render('MeupfPlateformBundle:Sermon:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 