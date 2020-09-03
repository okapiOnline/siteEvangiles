<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 07/04/2016
 * Time: 16:56
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Event;
use Meupf\PlateformBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class EventController extends Controller{

    public function indexAction()
    {


        $listevent = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Event')
            ->getEvents()
        ;

        $paginator  = $this->get('knp_paginator');
        $listEvents = $paginator->paginate(
            $listevent,
            $this->get('request')->query->getInt('page', 1)/*page number*/,
            25/*limit per page*/
        );


        return $this->render('MeupfPlateformBundle:Event:index.html.twig', array(
            'listEvents' => $listEvents,
        ));

    }

    public function countdownAction(){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('MeupfPlateformBundle:CategorieEvent')->find(2);

        return $this->render('MeupfFrontEndBundle::bar.html.twig', array(
            'event' => $event
        ));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('MeupfPlateformBundle:Event')->find($id);
        $events = $em->getRepository('MeupfPlateformBundle:Event')->findAll();
        if($event === null){
            throw $this->createNotFoundException("l'evenement de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfFrontEndBundle:Event:view.html.twig', array(
            'event' => $event,
            'events' => $events
        ));
    }

    public function addAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm(new EventType(), $event);

        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\'événement a bien été enregistrée avec succès.');

            return $this->redirect($this->generateUrl('meupf_event_home'));
        }

        return $this->render('MeupfPlateformBundle:Event:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('MeupfPlateformBundle:Event')->find($id);
        $form = $this->createForm(new EventType(), $event);

        if ($event == null) {
            throw $this->createNotFoundException("L'évenement d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\'événement a bien été modifiée avec succès.');

            return $this->redirect($this->generateUrl('meupf_event_home'));
        }

        return $this->render('MeupfPlateformBundle:Event:edit.html.twig', array(
            'form' => $form->createView(), 'event' => $event
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('MeupfPlateformBundle:Event')->find($id);
        $form = $this->createForm(new EventType(), $event);

        if ($event == null) {
            throw $this->createNotFoundException("La evenement d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($event);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'L\'événement a bien été supprimée avec succès.');

            return $this->redirect($this->generateUrl('meupf_event_home'));

        }

        return $this->render('MeupfPlateformBundle:Event:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }

} 