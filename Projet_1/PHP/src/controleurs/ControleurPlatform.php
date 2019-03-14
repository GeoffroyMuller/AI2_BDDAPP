<?php

namespace gamepedia\controleurs;

use gamepedia\models\Platform;
use gamepedia\vues\VuePrincipal as VuePrincipal;

class ControleurPlatform
{

    public function grossesPlatforms()
    {
        $res = "<h3>Question n°3 : liste des plateformes ayant plus de 10M d'installations</h3>";
        $platforms = Platform::where('install_base', '>=', '10000000')->get();
        foreach($platforms as $platform) {
            $res .= "Nom de la plateforme : $platform->name <br>";
        }

        (new VuePrincipal($res))->render();
    }

}
