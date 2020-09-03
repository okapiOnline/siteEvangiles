<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 09/05/2016
 * Time: 15:30
 */

namespace Meupf\FrontEndBundle\Controller;


use Meupf\PlateformBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FrontController extends Controller {

    public function contactAction(Request $request)
    {
        $em           = $this->getDoctrine()->getManager();
        $lastArticles = $em->getRepository('MeupfPlateformBundle:Article')->lastArticle(3);
        $form = $this->createForm(new ContactType());

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('kimkayna@gmail.com')
                    ->setBody( $this->renderView('MeupfFrontEndBundle:Contact:contact.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'name' => $form->get('name')->getData(),
                                'phone'=> $form->get('phone')->getData(),
                                'message' => $form->get('message')->getData()
                            )
                    ));

                $this->get('mailer')->send($message);
                $request->getSession()->getFlashBag()->add('success', 'Votre email a été envoyé! Merci!');
                return $this->redirect($this->generateUrl('contact'));
            }
        }

        return $this->render('MeupfFrontEndBundle:Contact:contact.html.twig', array(
            'form' => $form->createView(), 'lastArticles' => $lastArticles
        ));

    }

    public function sendAction(){
        $em           = $this->getDoctrine()->getManager();
        $lastArticles = $em->getRepository('MeupfPlateformBundle:Article')->lastArticle(3);

        return $this->render('MeupfFrontEndBundle:Contact:contact.html.twig', array(
            'lastArticles' => $lastArticles
        ));
    }

    public function AboutUsAction(){
        return $this->render('MeupfFrontEndBundle:AboutUs:aboutUs.html.twig');
    }

    public function responsableAction(){
        // On récupère notre objet Paginator
        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Responsable');
        $responsables = $em->findResponsable(9);

        return $this->render('MeupfFrontEndBundle:Responsable:index.html.twig', array(
            'responsables' => $responsables,
        ));
    }

    public function fondementAction(){
        //l'affichage se fait en dur
        return $this->render('MeupfFrontEndBundle:Fondement:index.html.twig');
    }

    public function histoireAction(){
        //l'affichage se fait en dur
        return $this->render('MeupfFrontEndBundle:Histoire:index.html.twig');
    }


    public function articlesAction(){
        // On récupère notre objet Paginator
        $em          = $this->getDoctrine()->getManager();
        $listarticle    = $em->getRepository('MeupfPlateformBundle:Article')->getArticles();
        $catposts    = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->getCategorieArticle(5);

        $paginator  = $this->get('knp_paginator');
        $articles = $paginator->paginate(
            $listarticle,
            $this->get('request')->query->getInt('page', 1)/*page number*/,
            7/*limit per page*/
        );
        return $this->render('MeupfFrontEndBundle:Post:index.html.twig', array(
            'articles' => $articles,
            'catposts' => $catposts
        ));
    }

    public function eventsAction(){
        $em           = $this->getDoctrine()->getManager();
        $listevent    = $em->getRepository('MeupfPlateformBundle:Event')->getEvents();
       // $catposts    = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->getCategorieArticle(5);

        $paginator  = $this->get('knp_paginator');
        $events = $paginator->paginate(
            $listevent,
            $this->get('request')->query->getInt('page', 1)/*page number*/,
            13/*limit per page*/
        );
        return $this->render('MeupfFrontEndBundle:Event:events.html.twig', array(
            'events' => $events,
        ));
    }

    //viewArticle
    public function viewAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $article    = $em->getRepository('MeupfPlateformBundle:Article')->find($id);
        $articles   = $em->getRepository('MeupfPlateformBundle:Article')->findAll();
        $comments   = $em->getRepository('MeupfPlateformBundle:Comment')->getCommentsForArticle($article->getId());
        $catposts   = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->getCategorieArticle(5);


        if($article === null){
            throw $this->createNotFoundException("L'article de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfFrontEndBundle:Post:view.html.twig', array(
            'article'  => $article,
            'articles' => $articles,
            'comments' => $comments,
            'catposts' => $catposts
        ));
    }

    public function sermonsAction(){
        $em           = $this->getDoctrine()->getManager();
        $listsermon   = $em->getRepository('MeupfPlateformBundle:Sermon')->getSermons();
        $catSermons   = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->getCategorieSermon(5);
       // $sermoncount = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->getTot();

        $paginator  = $this->get('knp_paginator');
        $sermons = $paginator->paginate(
            $listsermon,
            $this->get('request')->query->getInt('page', 1)/*page number*/,
            7/*limit per page*/
        );

        return $this->render('MeupfFrontEndBundle:Sermon:index.html.twig', array(
            'sermons'     => $sermons,
            'catSermons'  => $catSermons,
           // 'sermoncount' => $sermoncount
        ));
    }

    public function temoignagesAction(){
        $em             = $this->getDoctrine()->getManager();
        $listemoignage    = $em->getRepository('MeupfPlateformBundle:Temoignage')->getTemoignages();
        //$catSermons = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->getCategorieSermon(5);

        $paginator  = $this->get('knp_paginator');
        $temoignages = $paginator->paginate(
            $listemoignage,
            $this->get('request')->query->getInt('page', 1)/*page number*/,
            9/*limit per page*/
        );
        return $this->render('MeupfFrontEndBundle:Temoignage:index.html.twig', array(
            'temoignages' => $temoignages
           // 'catSermons'  => $catSermons,
        ));
    }


    public function viewSermonAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $sermon = $em->getRepository('MeupfPlateformBundle:Sermon')->find($id);

        if($sermon === null){
            throw $this->createNotFoundException("le sermon de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfFrontEndBundle:Sermon:view.html.twig', array(
            'sermon' => $sermon,
        ));
    }

    public function viewTemoignageAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository('MeupfPlateformBundle:Temoignage')->find($id);

        if($temoignage === null){
            throw $this->createNotFoundException("le temoignage de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfFrontEndBundle:Temoignage:view.html.twig', array(
            'temoignage' => $temoignage,
        ));
    }

    public function viewEventAction($id)
    {
        $em           = $this->getDoctrine()->getManager();
        $event        = $em->getRepository('MeupfPlateformBundle:Event')->find($id);
        $events       = $em->getRepository('MeupfPlateformBundle:Event')->getEvents(1, 5);
        $lastArticles = $em->getRepository('MeupfPlateformBundle:Article')->lastArticle(3);
        $catEvents    = $em->getRepository('MeupfPlateformBundle:CategorieEvent')->getCategorieEvent(5);

        if($event === null){
            throw $this->createNotFoundException("l'evenement de l'id ".$id." n'existe pas");
        }
        return $this->render('MeupfFrontEndBundle:Event:view.html.twig', array(
            'event'        => $event,
            'events'       => $events,
            'lastArticles' =>$lastArticles,
            'catEvents'    => $catEvents
        ));
    }

    public function sermonsByCategorieAction($id){
        $em     = $this->getDoctrine()->getManager();
        $sermons = $em->getRepository('MeupfPlateformBundle:Sermon')->getSermonCategorie(1, 5, $id);
        $catSermons = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->getCategorieSermon(5);

        $catSermonslug    = $em->getRepository('MeupfPlateformBundle:CategorieSermon')->find($id);


        return $this->render('MeupfFrontEndBundle:CategorieSermon:index.html.twig', array(
            'sermons'       => $sermons,
            'catSermonslug' => $catSermonslug,
            'catSermons'    => $catSermons
        ));
    }

    public function articlesByCategorieAction($id){
        $em     = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('MeupfPlateformBundle:Article')->getArticleCategorie(1, 5, $id);
        $catposts    = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->getCategorieArticle(5);
        $catpostslug    = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->find($id);



        return $this->render('MeupfFrontEndBundle:CategorieArticle:index.html.twig', array(
            'articles' => $articles,
            'catposts' => $catposts,
            'catpostslug'  => $catpostslug
        ));
    }


    public function mediaAction(){
        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Media');
        $listmedia = $em->getMedias();

        $paginator  = $this->get('knp_paginator');
        $medias = $paginator->paginate(
            $listmedia,
            $this->get('request')->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('MeupfFrontEndBundle:Media:index.html.twig', array(
            'medias'    => $medias,
        ));
    }

    public function indexAction(){

        // On récupère notre objet Paginator
        $listArticles = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Article')
            ->lastArticle(3)
        ;

        $listSlides = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Slider')
            ->lastSlider(4)
        ;


        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Sermon');

        $listSermons = $em->findAll();
        $lastSermons = $em->lastSermon(3);
        $lastSermonVideos = $em->lastSermonVideo(1);

        $listEvents = $this->getDoctrine()
            ->getManager()
            ->getRepository('MeupfPlateformBundle:Event')
            ->lastEvent(3)
        ;

        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('MeupfPlateformBundle:Gallery')->lastImage(3);



        return $this->render('MeupfFrontEndBundle:Home:index.html.twig', array(
            'listArticles' => $listArticles,
            'listEvents'   => $listEvents,
            'listSermons'  => $listSermons,
            'lastSermons'  => $lastSermons,
            'lastSermonVideos' => $lastSermonVideos,
            'listSlides'  => $listSlides,
            'images'      => $images
        ));
    }

    public function gallerieAction(){
        $em          = $this->getDoctrine()->getManager();
        $listImage    = $em->getRepository('MeupfPlateformBundle:Gallery')->getGalleries();
        //$catposts    = $em->getRepository('MeupfPlateformBundle:CategorieArticle')->getCategorieArticle(5);

        $paginator  = $this->get('knp_paginator');
        $images = $paginator->paginate(
            $listImage,
            $this->get('request')->query->getInt('page', 1)/*page number*/,
            7/*limit per page*/
        );
        return $this->render('MeupfFrontEndBundle:Gallerie:index.html.twig', array(
            'images' => $images,
        ));
    }

    public function downloadAction($filename){
        $request = $this->get('request');
        $path = $this->get('kernel')->getRootDir(). "/../web/downloads/";
        $content = file_get_contents($path.$filename);

        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);

        $response->setContent($content);
        return $response;
    }
} 