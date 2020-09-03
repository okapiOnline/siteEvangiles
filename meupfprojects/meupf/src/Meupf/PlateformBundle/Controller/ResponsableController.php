<?php

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Responsable;
use Meupf\PlateformBundle\Form\ResponsableType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResponsableController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $em =   $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Responsable');

        $listResponsables = $em->getResponsables($page, $nbPerPage);

        $nbPages = ceil(count($listResponsables)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:Responsable:index.html.twig', array(
            'listResponsables' => $listResponsables,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));
    }

    public function addAction(Request $request)
    {
        $responsable = new Responsable();
        $form = $this->createForm(new ResponsableType(), $responsable);

        if($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($responsable);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le responsable a bien été enregistré avec succès');

            return $this->redirect($this->generateUrl('meupf_responsable_home'));
        }

        return $this->render('MeupfPlateformBundle:Responsable:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        $responsable = $em->getRepository('MeupfPlateformBundle:Responsable')->find($id);
        $form = $this->createForm(new ResponsableType(), $responsable);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($responsable == null) {
            throw $this->createNotFoundException("Le pasteur d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le responsable a bien été modifié avec succès');
            return $this->redirect($this->generateUrl('meupf_responsable_home'));
        }

        return $this->render('MeupfPlateformBundle:Responsable:edit.html.twig', array(
            'form' => $form->createView(), 'responsable' => $responsable
        ));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $responsable = $em->getRepository('MeupfPlateformBundle:Responsable')->find($id);

        if($responsable === null){
            throw $this->createNotFoundException("le responsable de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:Responsable:view.html.twig', array(
            'responsable' => $responsable
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $responsable = $em->getRepository('MeupfPlateformBundle:Responsable')->find($id);
        $form = $this->createForm(new ResponsableType(), $responsable);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($responsable == null) {
            throw $this->createNotFoundException("Le responsable d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($responsable);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le responsable a bien été supprimée avec succès');

            return $this->redirect($this->generateUrl('meupf_responsable_home'));

        }

        // Si la requête est en GET, on affiche une page de confirmation avant de delete
        return $this->render('MeupfPlateformBundle:Responsable:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
