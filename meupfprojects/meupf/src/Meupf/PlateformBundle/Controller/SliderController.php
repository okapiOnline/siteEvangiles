<?php

namespace Meupf\PlateformBundle\Controller;

use Meupf\PlateformBundle\Entity\Slider;
use Meupf\PlateformBundle\Form\SliderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SliderController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $listSlides = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Slider')
            ->getSliders($page, $nbPerPage)
        ;

        $nbPages = ceil(count($listSlides)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfPlateformBundle:Slider:index.html.twig', array(
            'listSlides' => $listSlides,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }


    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $slider = $em->getRepository('MeupfPlateformBundle:Slider')->find($id);

        if($slider === null){
            throw $this->createNotFoundException("le slider de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:Slider:view.html.twig', array(
            'slider' => $slider
        ));
    }

    public function addAction(Request $request)
    {
        $slider = new Slider();
        $form = $this->createForm(new SliderType(), $slider);

        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le slide a bien été enregistré avec succès');

            return $this->redirect($this->generateUrl('meupf_slider_home'));
        }

        return $this->render('MeupfPlateformBundle:Slider:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $slider = $em->getRepository('MeupfPlateformBundle:Slider')->find($id);
        $form = $this->createForm(new SliderType(), $slider);

        if ($slider == null) {
            throw $this->createNotFoundException("Le slider d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Le slide a bien été modifié avec succès');

            return $this->redirect($this->generateUrl('meupf_slider_home'));
        }


        return $this->render('MeupfPlateformBundle:Slider:edit.html.twig', array(
            'form' => $form->createView(), 'slider' => $slider
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $slider = $em->getRepository('MeupfPlateformBundle:Slider')->find($id);
        $form = $this->createForm(new SliderType(), $slider);

        if ($slider == null) {
            throw $this->createNotFoundException("Le slider d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($slider);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Le slide a bien été supprimé avec succès');

            return $this->redirect($this->generateUrl('meupf_slider_home'));

        }

        return $this->render('MeupfPlateformBundle:Slider:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }


}
