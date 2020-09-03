<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 22/04/2016
 * Time: 14:46
 */

namespace Meupf\FrontEndBundle\Beta;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class BetaListener {

    //le processeur
    protected $betaHTML;

    /*
     * la date de fin de la l'évenement
     * avant cette dte, on affichera un compte aà rebours
     * après cette date on affichera plus rien
     */
    protected $endDate;

    public function __construct(BetaHTML $betaHTML, $endDate){
        $this->betaHTML = $betaHTML;
        $this->endDate  = new \DateTime($endDate);
    }


    public function processBeta(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }
        $remainingDays = $this->endDate->diff(new \Datetime())->format('%d');
        // Si la date est dépassée, on ne fait rien
        if ($remainingDays <= 0) {
            return;
        }
        // On utilise notre BetaHRML
        $response = $this->betaHTML->displayBeta($event->getResponse(), $remainingDays);
        // On met à jour la réponse avec la nouvelle valeur
        $event->setResponse($response);
    }


    public  function ignoreBeta(){

    }
} 