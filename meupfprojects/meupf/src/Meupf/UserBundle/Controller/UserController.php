<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 19/05/2016
 * Time: 17:04
 */

namespace Meupf\UserBundle\Controller;


use Meupf\UserBundle\Form\Type\EditorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    public function indexAction($page){

        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $listUsers = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfUserBundle:User')
            ->getUsers($page, $nbPerPage)
        ;

        $nbPages = ceil(count($listUsers)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('MeupfUserBundle:User:index.html.twig', array(
            'listUsers' => $listUsers,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));
    }

    public function editAction($id, Request $request){

        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('MeupfUserBundle:User')->find($id);

        //$listUsers = $em->getRepository('MeupfUserBundle:User')->findAll();
        $form = $this->createForm(new EditorFormType(), $user);

        if ($user == null) {
            throw $this->createNotFoundException("L'utlisateur d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\'utilisateur a été modifié avec succès');
            return $this->redirect($this->generateUrl('meupf_user_registration_home'));
        }

        return $this->render('MeupfUserBundle:User:edit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
            // 'listUsers' => $listUsers
        ));


    }
} 