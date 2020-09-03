<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 31/03/2016
 * Time: 17:55
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Service;
use Meupf\PlateformBundle\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $listServices = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Service')
            ->getServices($page, $nbPerPage)
        ;

        $nbPages = ceil(count($listServices)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        // On donne toutes les informations nécessaires à la vue
        return $this->render('MeupfPlateformBundle:Service:index.html.twig', array(
            'listServices' => $listServices,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('MeupfPlateform:Service')->find($id);

        if($service === null){
            throw $this->createNotFoundException("le service de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:Service:view.html.twig', array(
            'service' => $service
        ));
    }

    public function addAction(Request $request)
    {
        $service = new Service();
        $form = $this->createForm(new ServiceType(), $service);


        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le service a bien été enregistré avec succès');


            return $this->redirect($this->generateUrl('meupf_service_home'));
        }


        return $this->render('MeupfPlateformBundle:Service:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository('MeupfPlateformBundle:Service')->find($id);
        $form = $this->createForm(new ServiceType(), $service);

        if ($service == null) {
            throw $this->createNotFoundException("Le service d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le service a bien été modifié avec succès');

            return $this->redirect($this->generateUrl('meupf_service_home'));
        }


        // Ici, on s'occupera de la création et de la gestion du formulaire
        return $this->render('MeupfPlateformBundle:Service:edit.html.twig', array(
            'form' => $form->createView(), 'service' => $service
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $service = $em->getRepository('MeupfPlateformBundle:Service')->find($id);
        $form = $this->createForm(new ServiceType(), $service);

        if ($service == null) {
            throw $this->createNotFoundException("Le service d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($service);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le service a bien été supprimé avec succès');

            return $this->redirect($this->generateUrl('meupf_service_home'));

        }

        // Si la requête est en GET, on affiche une page de confirmation avant de delete
        return $this->render('MeupfPlateformBundle:Service:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }
} 