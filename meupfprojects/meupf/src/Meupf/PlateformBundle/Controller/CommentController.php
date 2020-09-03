<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 16/04/2016
 * Time: 01:13
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Comment;
use Meupf\PlateformBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;

class CommentController extends Controller{

    public function newAction($article_id)
    {
        $article = $this->getArticle($article_id);

        $comment = new Comment();
        $comment->setArticle($article);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('MeupfFrontEndBundle:Comments:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createAction($article_id, Request $request)
    {
        $article = $this->getArticle($article_id);

        $comment  = new Comment();
        $comment->setArticle($article);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity

            return $this->redirect($this->generateUrl('meupf_front_end_view_slug', array(
                    'id' => $comment->getArticle()->getId())) .
                '#comment-' . $comment->getId()
            );
        }


        return $this->render('MeupfFrontEndBundle:Comments:form.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getArticle($article_id)
    {
        $em = $this->getDoctrine()
            ->getEntityManager();

        $article = $em->getRepository('MeupfFrontEndBundle:Article')->find($article_id);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $article;
    }
} 