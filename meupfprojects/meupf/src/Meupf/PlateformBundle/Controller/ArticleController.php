<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 28/03/2016
 * Time: 18:02
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\Article;
use Meupf\PlateformBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ArticleController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        $listArticles = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Article')
            ->getArticles($page, $nbPerPage)
        ;

        // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
        $nbPages = ceil(count($listArticles)/$nbPerPage);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        // On donne toutes les informations nécessaires à la vue
        return $this->render('MeupfPlateformBundle:Article:index.html.twig', array(
            'listArticles' => $listArticles,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('MeupfPlateformBundle:Article')->find($id);
        $articles = $em->getRepository('MeupfPlateformBundle:Article')->findAll();
        $comments = $em->getRepository('MeupfPlateformBundle:Comment')
            ->getCommentsForArticle($article->getId());
       // $catposts = $em->getCategories();
        if($article === null){
            throw $this->createNotFoundException("L'article de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfFrontEndBundle:Post:view.html.twig', array(
            'article'  => $article,
            'articles' => $articles,
            'comments' => $comments,
         //   'catposts' => $catposts
        ));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(new ArticleType, $article);

        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\' article a bien été enregistré avec succès.');

            return $this->redirect($this->generateUrl('meupf_article_home'));
        }

        return $this->render('MeupfPlateformBundle:Article:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('MeupfPlateformBundle:Article')->find($id);
        $form = $this->createForm(new ArticleType(), $article);

        // Si l'annonce n'existe pas, on affiche une erreur 404
        if ($article == null) {
            throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'L\' article a bien été modifié avec succès.');

            return $this->redirect($this->generateUrl('meupf_article_home'));
        }
            //echo var_dump($form);
        return $this->render('MeupfPlateformBundle:Article:edit.html.twig', array(
            'form' => $form->createView(), 'article' => $article
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('MeupfPlateformBundle:Article')->find($id);
        $form = $this->createForm(new ArticleType, $article);

        if ($article == null) {
            throw $this->createNotFoundException("L'article d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($article);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'L\' article a bien été supprimé avec succès.');

            return $this->redirect($this->generateUrl('meupf_article_home'));

        }

        return $this->render('MeupfPlateformBundle:Article:delete.html.twig', array(
             'form' => $form->createView()
        ));
    }

} 