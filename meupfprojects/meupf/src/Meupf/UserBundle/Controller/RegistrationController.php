<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 31/03/2016
 * Time: 15:55
 */

namespace Meupf\UserBundle\Controller;



use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Meupf\UserBundle\Entity\User;
use Meupf\UserBundle\Form\Type\EditorFormType;
use Meupf\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FilterUserResponseEvent;



class RegistrationController extends BaseController  {

    public function addAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(new RegistrationFormType($request), $user);

        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\'utilisateur a bien été enregistré avec succès.');

            return $this->redirect($this->generateUrl('meupf_user_registration_home'));
        }

        return $this->render('MeupfUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

} 