<?php

namespace Meupf\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MeupfUserBundle extends Bundle
{

    //pour utiliser un bundle telecharger
    public function getParent(){
        return 'FOSUserBundle';
    }
}
