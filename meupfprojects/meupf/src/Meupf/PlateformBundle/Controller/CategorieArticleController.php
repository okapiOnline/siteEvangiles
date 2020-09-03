<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 31/03/2016
 * Time: 15:58
 */

namespace Meupf\PlateformBundle\Controller;


use Meupf\PlateformBundle\Entity\CategorieArticle;
use Meupf\PlateformBundle\Form\CategorieArticleType;
use Meupf\PlateformBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieArticleController extends Controller{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 15;

        // On récupère notre objet Paginator
        $listCategories = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:CategorieArticle')
            ->getCategories($page, $nbPerPage)
        ;

        // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
        $nbPages = ceil(count($listCategories)/$nbPerPage);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        // On donne toutes les informations nécessaires à la vue
        return $this->render('MeupfPlateformBundle:CategorieArticle:index.html.twig', array(
            'listCategories' => $listCategories,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));

    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateform:CategorieArticle')->find($id);

        if($categorie === null){
            throw $this->createNotFoundException("la categorie de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfPlateformBundle:CategorieArticle:view.html.twig', array(
            'categorie' => $categorie
        ));
    }

    public function addAction(Request $request)
    {
        $categorie = new CategorieArticle();
        $form = $this->createForm(new CategorieArticleType(), $categorie);


        if($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été enregistrée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_article_home'));
        }

        return $this->render('MeupfPlateformBundle:CategorieArticle:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->find($id);
        $form = $this->createForm(new CategorieArticleType(), $categorie);

        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }

        $form->handleRequest($request);

        if ( $form->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été modifiée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_article_home'));
        }


        return $this->render('MeupfPlateformBundle:CategorieArticle:edit.html.twig', array(
            'form' => $form->createView(), 'categorie' => $categorie
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->find($id);
        $form = $this->createForm(new CategorieArticleType(), $categorie);

        if ($categorie == null) {
            throw $this->createNotFoundException("La categorie d'id ".$id." n'existe pas.");
        }



        if ($form->handleRequest($request)) {
            $em->remove($categorie);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La categorie a bien été supprimée avec succès.');

            return $this->redirect($this->generateUrl('meupf_categorie_article_home'));

        }

        return $this->render('MeupfPlateformBundle:CategorieArticle:delete.html.twig', array(
            'form' => $form->createView()
        ));
    }

} 