<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 31/03/2016
 * Time: 16:32
 */

namespace Meupf\PlateformBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller{

    public function indexAction(){
       // $url = $this->generateUrl('meupf_dashboard_home', array(), true);
        //$response = new Response($url);
       // return $response;
        return $this->render('MeupfPlateformBundle:Dashboard:index.html.twig');
    }
} 