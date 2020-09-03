<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 22/04/2016
 * Time: 14:27
 */

namespace Meupf\FrontEndBundle\Beta;

use Symfony\Component\HttpFoundation\Response;

class BetaHTML {

    public function displayBeta(Response $response, $reamainingDay){
        $content = $response->getContent();

        //code à rajouter
        $html = '<span style="color: red; font-size: 0.5em">'.(int) $reamainingDay.' </span>';

        //insertion du code dans la page dans le premier <h1>
        $content = preg_replace(
            '#<h1>(.*?)</h1>#iU',
            '<h1>$1'.$html.'</h1>',
            $content,
            1
        );

        //modification du contenue dans la reponse
        $response->setContent($content);
        return $response;
    }

} 